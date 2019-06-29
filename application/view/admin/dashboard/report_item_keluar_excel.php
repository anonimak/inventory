<style>
    table {
        border-collapse: collapse;
        }

    table, th, td {
    border: 1px solid black;
    }
</style>
<center>
    <h3>Report Item Keluar PT Toyota Boshoku Indonesia</h3>
    <h5>Periode <?= date("d/m/Y",strtotime($data['tgl_awal']))." - ".date("d/m/Y",strtotime($data["tgl_akhir"])) ?></h5>
</center>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Unique No</th>
            <th>Part Name</th>
            <th>Total Stock</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $i = 1;
            foreach ($data["data"] as $value) {
            $body = "
                    <tr>
                        <td>".$i++."</td>
                        <td>$value[uniq_no]</td>
                        <td>$value[part_name]</td>
                        <td>$value[total_stock]</td>
                    </tr>
                    ";
            echo $body;
            }
            
        ?>
    </tbody>
</table>