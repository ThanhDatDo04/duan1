<style>
    #i {
        margin-left: 600px;
    }

    /* #t {
        margin-left: 160px;
    } */
</style>

<body>
    <div class="container-fluid px-4">
        <h1 class="mb-4" id="i">Infor My Bill</h1>
        <div class="card mb-4">
            <div class="card-body" id="t">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id_bill</th>
                            <th>Date_order</th>
                            <th>Count_products</th>
                            <th>Total_bills</th>
                            <th>Status_bill</th>
                            <th>Bill_detail</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <?php
                    if (is_array($listbill)) {
                        foreach ($listbill as $bill) {
                            extract($bill);
                            // $ttdh = get_ttdh($bill['id_status_bill']);
                            $countsp = loadall_cart_count($id_bill);
                            $ctb = "index.php?act=bill_detail&id_bill=" . $id_bill;
                            $huydh = "index.php?act=update_bill&id_bill=" . $id_bill;
                            if ($id_status_bill != 1) {
                                $huydh = ''; // Không hiển thị nút xóa cho admin
                            } else {
                                $huydh = '<a href="' . $huydh . '" class="btn btn-danger"><input type="button" value="Unset bill" onclick ="return confirm(\'ban co chac chan muon huy don hang?\')" /></a>';
                            }
                            echo ' <tr>
                            <td>' . $id_bill . '</td>
                            <td>' . $date_order . '</td>
                            <td>' . $countsp . '</td>
                            <td>' . number_format($total_price, 0, ",", ".") . '$' . '</td>
                            <td>' . $name_status . '</td>
                            <td><a href="' . $ctb . '" class="btn btn-primary"><input type="button" value="See detail" /></a></td>
                            <td> ' . $huydh . '
                          </td>
                                     </tr>';
                        }
                    }
                    ?>

                </table>
            </div>
        </div>
    </div>