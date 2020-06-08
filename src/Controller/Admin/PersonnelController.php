<?php
namespace App\Controller\Admin;

use App\Entity\PersonnelSearch;
use App\Form\PersonnelSearchType;
use App\Repository\EtsouServiceRepository;
use phpDocumentor\Reflection\Types\Nullable;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Personnel;
use App\Form\PersonnelType;
use App\Repository\PersonnelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\ResponseHeaderBag;
// Include PhpSpreadsheet required namespaces
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\Validator\Constraints\Length;

//use Symfony\Component\validator\validator\ValidatorInterface;
class PersonnelController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var PersonnelRepository
     */
    private $repository;


    public function __construct( EntityManagerInterface $em, PersonnelRepository $repository )
    {

        $this->em = $em;
        $this->repository = $repository;
    }

    /**
     * 
     * @Route("personnel/", name="personnel.index")
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request):Response
    {       
        $search = new PersonnelSearch();
        $form  = $this->createForm(PersonnelSearchType::class, $search);
        $form->handleRequest($request);
        
        $sommeECD = $this->repository->sommeECD();
        $sommeEFA = $this->repository->sommeEFA();
        $sommeFONCT = $this->repository->sommeFONCT();

        $nombrePers = $this->repository->sommepersonnel();

        $ecd = ceil(($sommeECD / $nombrePers)*100);
        $efa = ceil(($sommeEFA / $nombrePers)*100);
        $fonct = ceil(($sommeFONCT / $nombrePers)*100); 

            $personnel = $paginator->paginate(
            $this->repository->findAllVisibleQuery($search ), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            20 /*limit per page*/
        );
        
        if ($request->get('export_excel')==1) { 
            $spreadsheet = new Spreadsheet();
        
        /* @var $sheet \PhpOffice\PhpSpreadsheet\Writer\Xlsx\Worksheet */
        $sheet = $spreadsheet->getActiveSheet();
        
/*         $sheet->setCellValue('A1', 'Nom et Prénoms ');
        $sheet->setCellValue('B1', 'Téléphone ');
        $sheet->setCellValue('C1', 'Adresse ');
        $sheet->setCellValue('D1', 'Service ou Etablissement');
        $sheet->setCellValue('E1', 'Catégorie'); */
            $personnel = $this->repository->exportExcel($search); 
            
            foreach ($personnel as $key => $perso) {
                
                // dd(count($perso));
                // $key = $key + 2 ;                   
                    
                $sheet->setCellValue("A{$key}", $perso->getNomprenom());  
                $sheet->setCellValue("B{$key}", $perso->getTelephone());
                $sheet->setCellValue("C{$key}", $perso->getAdresseactuelle()); 
                if ( $perso->getEtsouservice()) {
                    $var =  $perso->getEtsouservice()->getEtsouservice();
                }else{
                    $var = "";
                }
                $sheet->setCellValue("D{$key}", $var); 
                $sheet->setCellValue("E{$key}", $perso->getCategorie()->getCategorie()); 

            } 

        $sheet->setTitle("Personnel Civil");
        // Create your Office 2007 Excel (XLSX Format)
        $writer = new Xlsx($spreadsheet);
        
        // Crée temporairement le fichier dans le system
        $fileName = 'PersonnelCivil.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        
        // Créez le fichier Excel dans le répertoire tmp du système
        $writer->save($temp_file);
        
        // Return the excel file as an attachment
        return $this->file($temp_file, $fileName, ResponseHeaderBag::DISPOSITION_INLINE);
        }
        
        return $this->render('admin/index.html.twig', [
            'personnels' => $personnel,
            'form' => $form->createView(),
            'exportexcel' => $request->get('export_excel'),
            'nombrePersonnel' => $nombrePers,
            'sommeECD' => $ecd,
            'sommeEFA' => $efa,
            'sommeFONCT' => $fonct,
            'effectECD' => $sommeECD,
            'effectEFA' => $sommeEFA,
            'effectFONCT' => $sommeFONCT,
        ]);

    }

    /**
     * @Route("admin/personnel/new", name="personnel.new")
     * @param Request $request
     * @return Response
     */
    public function add(Request $request):Response
    {
        $personnel = new Personnel();

/*

        $errors = $validator->validate($personnel);
        if (count($errors) > 0) {
            $errors = (string)$errors;
            return $this->redirectToRoute('personnel.new', [
                '$errors' => $errors
                ],301);
        }
*/
        
        $form = $this->createForm(PersonnelType::class,$personnel);
        $form->handleRequest($request);


       if ($form->isSubmitted() and $form->isValid())
        {
            $date = $personnel->getDatenaisse();
            $date = date_add($date, date_interval_create_from_date_string('65 years'));
            $personnel->setDateRetraite(new \DateTime(date_format($date, 'Y-m-d'))) ;
 

            $this->em->persist($personnel);

            $this->em->flush();
            $this->addFlash('success', "Enregistrement éfféctué avec succes !");
            return $this->redirectToRoute('personnel.new');
        }

        return   $this->render('admin/new.html.twig',[
            'form' => $form->createView(),
            ]);

    }

    /**
     * @Route("admin/personnel/{slug}-{id}", name="personnel.edit" , requirements = {"slug": "[a-z0-9\-]*"})
     * @param Personnel $personnel
     * @return Response
     */
     public function edit(Personnel $personnel, String $slug = null , Request $request):Response
     {
         $personnel = $this->repository->findOneById($personnel);
         $form = $this->createForm(PersonnelType::class, $personnel);
         $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid())
         {

             $this->em->flush();
             $this->addFlash('success', "Modification éfféctué avec succes !");
           return $this->redirectToRoute('personnel.show', [
            'id' => $personnel->getId(),
            'slug' => $personnel->getSlug()
           ]);
         }

         return $this->render("admin/edit.html.twig", [
             'personnel' => $personnel,
             'form' => $form->createView(),
         ]);


     }
     
}