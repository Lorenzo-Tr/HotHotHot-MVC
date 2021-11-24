<?php
class Etudiant extends Controller{
  public function index($error = null){
    $data['error'] = $error;
    $data['title'] = "Accueil";
    
    $this->view('home', $data);
  }

  public function result(){
    $list = Upload::getUploadedFile('file');
    if(is_null($list)){
      $this->redirect('');
    }else{
      $data['A_groups'] = GroupsMaker::makeGroups($list, $_POST['wantedNbGroups']);
      $data['title'] = "Random Groups";
      $data['id'] = md5(uniqid(rand(), true));
      $cache = $this->view('groups', $data);
      //remove download btn
      $cache = preg_replace('/^.*(?:class="to_pdf_btn").*$(?:\r\n|\n)?/m', '', $cache);
      //remove title
      $cache = preg_replace('/^.*(?:h1).*$(?:\r\n|\n)?/m', '', $cache);
      //replace css
      $cache = preg_replace('/<style>(.*$(?:\r\n|\n))*<\/style>/m',"<style>".file_get_contents(APP_PATH . '/resources/css/pdf.css')."</style>",$cache);
      //create a temp file
      file_put_contents(APP_PATH . "/tmp/cache/pdf".$data['id'].".html", $cache) ;
    }
  }

  public function pdf($id){
    require_once APP_PATH . '/vendor/autoload.php';

    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML(file_get_contents(APP_PATH . "/tmp/cache/pdf$id.html"));
    return $mpdf->Output();
  }
}