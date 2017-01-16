<?php

class AttendeesController
{
    public function show()
    {
        if (!isset($_GET['id'])) {
            redirect();
        }
        $event_id = $_GET['id'];
        $event = Event::find($event_id);
        if (!$event) {
            redirect();
        }
        $attendees = Attendee::allWhere($event_id);
        require_once 'views/attendees/show.php';
    }

    public function create()
    {
        // Allow access only for users
        if (!isset($_SESSION['auth_id']) || !isset($_GET['id'])) {
            redirect();
        }
        $user_id = $_SESSION['auth_id'];
        $event_id = $_GET['id'];
        $event = Event::find($event_id);
        if (!$event) {
            redirect();
        }
        if (strtotime($event['scheduled_at']) <= time() || in_array($user_id, array($event['speaker_1'], $event['speaker_2'], $event['speaker_3']))) {
            redirect();
        }
        if (Attendee::countWhere($user_id, $event_id) == 0) {
            Attendee::insert($user_id, $event_id);
        }
        $_SESSION['flash'] = ['class' => 'success', 'message' => 'Ai fost înscris pe lista participanților la eveniment.'];
        redirect('?page=attendees&action=show&id=' . $event_id);
    }

    public function export()
    {
        error_reporting(E_ALL);
        ini_set('display_errors', true);
        ini_set('display_startup_errors', true);
        if (PHP_SAPI == 'cli') {
            die('Această pagină poate fi accesată doar dintr-un browser web.');
        }
        require_once dirname(__FILE__) . '/../libraries/PHPExcel/Classes/PHPExcel.php';
        if (!isset($_GET['id'])) {
            redirect();
        }
        $event_id = $_GET['id'];
        $event = Event::find($event_id);
        if (!$event) {
            redirect();
        }
        $attendees = Attendee::allWhere($event_id);
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("Events App")
            ->setLastModifiedBy("Events App")
            ->setTitle("Export participanți evenimentul " . $event['title'])
            ->setSubject("Export participanți evenimentul " . $event['title']);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nr Crt')
            ->setCellValue('B1', 'Nume')
            ->setCellValue('C1', 'Email')
            ->setCellValue('D1', 'Job')
            ->setCellValue('E1', 'Prezent');
        if ($attendees) {
            $row = 2;
            foreach ($attendees as $user) {
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue("A$row", ($row - 1))
                    ->setCellValue("B$row", $user['full_name'])
                    ->setCellValue("C$row", $user['email'])
                    ->setCellValue("D$row", $user['job_title'])
                    ->setCellValue("E$row", '');
                $row++;
            }
        }
        foreach (['A', 'B', 'C', 'D', 'E'] as $column) {
            $objPHPExcel->getActiveSheet()
                ->getColumnDimension($column)
                ->setAutoSize(true);
        }
        $objPHPExcel->getActiveSheet()->setTitle('Participanți');
        $objPHPExcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="export_participanti_eveniment.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }
}
