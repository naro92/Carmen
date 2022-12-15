<?php

if (isset($_POST['nom']) && isset($_POST['date_debut']) && isset($_POST['date_fin'])) {
    $patientName = $_POST['nom'];
    $startDate = $_POST['date_debut'];
    $endDate = $_POST['date_fin'];
    
    // 从数据库中获取账单信息
    $sql = "SELECT * FROM bill WHERE name = '$patientName' AND date BETWEEN '$startDate' AND '$endDate'";
    $result = mysqli_query($conn, $sql);
    
    // 生成PDF文件
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont("Arial", "B", 16);
    $pdf->Cell(40, 10, "Patient Bill");
 
    // 遍历账单信息，并写入PDF文件
    while ($row = mysqli_fetch_assoc($result)) {
        $pdf->Cell(40, 10, $row['item']);
        $pdf->Cell(40, 10, $row['amount']);
        $pdf->Cell(40, 10, $row['date']);
    }
    
    // 保存PDF文件
    $fileName = 'bill_' . date('YmdHis') . '.pdf';
    $pdf->Output('F', $fileName);
    
    // 返回PDF文件路径
    $url = '/path/to/pdf/' . $fileName;
    echo json_encode(array('url' => $url));
}
?>
