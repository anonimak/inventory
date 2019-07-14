<style>
    table {
        border-collapse: collapse;
        }

    table, th, td {
    border: 1px solid black;
    }
</style>
<center>
    <h3>Report Stok Part Tersedia PT Toyota Boshoku Indonesia</h3>
</center>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Unique No</th>
            <th>Part Name</th>
            <th>Supplier</th>
            <th>Model</th>
            <th>Part Number</th>
            <th>Stock</th>
            <th>Stock Min</th>
            <th>Qty</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $i = 1;
            foreach ($data['data'] as $value) {
            $body = "
                    <tr>
                        <td>".$i++."</td>
                        <td>$value[uniq_no]</td>
                        <td>$value[part_name]</td>
                        <td>$value[nama]</td>
                        <td>$value[model]</td>
                        <td>$value[part_number]</td>
                        <td>$value[stock]</td>
                        <td>$value[stock_min]</td>
                        <td>$value[qty]</td>
                    </tr>
                    ";
            echo $body;
            }
        ?>
    </tbody>
</table>