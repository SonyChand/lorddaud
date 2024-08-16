<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }

        .tabel1 {
            border-collapse: collapse;
            /* Merges borders for a clean look */
            width: 100%;
            /* Adjust as needed */
        }

        .tabelKOP {
            border-collapse: collapse;
            /* Merges borders for a clean look */
            width: 100%;
            /* Adjust as needed */
        }

        .tabelKOP td {
            /* Styles table cells (both data and header cells) */
            padding: 8px;
            text-align: center;
            /* Adjust as needed */
        }

        .tabel1 td {
            /* Styles table cells (both data and header cells) */
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
            /* Adjust as needed */
        }

        .tabel1 th {
            /* Styles table cells (both data and header cells) */
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
            background-color: lightgray;
            /* Adjust as needed */
        }
    </style>

</head>

<body>
    <table class="tabelKOP" style="border-color: black !important;border-bottom-style:double !important;line-height:1.3;">
        <tr>
            <td style="width: 20% !important;" class="text-start">
                <img src="<?= base_url('assets/img/logo/kop.jpg'); ?>" width="70">
            </td>
            <td class="text-center">
                <span style="font-size: 15px;">SISTEM INFORMASI AKADEMIK</span><br>
                <span style="font-size: 15px;"><?= strtoupper($title) ?></span><br>
                <span style="font-size: 15px;"><?= base_url() ?></span><br>
                <!-- <strong style="font-size: 15px;"><?= strtoupper($dd['puskes']); ?></strong><br> -->
            </td>
            <td style="width: 20% !important;" class="text-start">
                <img src="<?= base_url('assets/img/logo/kop.jpg'); ?>" width="70">
            </td>
        </tr>
    </table><br>

    <table width="100%" class="tabel1">
        <thead>
            <tr>
                <th>#</th>
                <th>Akun Pengguna</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>No HP</th>
                <th>Pendidikan</th>
                <th>Tanggal Dibuat</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($data1 as $row) : ?>
                <?php $akun = $this->db->get_where('pengguna', ['id' => $row->id_user])->row(); ?>
                <tr>
                    <th scope="row"><?= $i++ ?></th>
                    <td>
                        <?php if ($akun) {
                            echo $akun->email;
                        } else {
                            echo 'Belum dikaitkan';
                        } ?>
                    </td>
                    <td><?= $row->nik ?></td>
                    <td><?= $row->nama ?></td>
                    <td><?= $row->jk ?></td>
                    <td><?= $row->no_hp ?></td>
                    <td><?= $row->pendidikan ?></td>
                    <td><?= tanggal_indonesia(date('Y-m-d', $row->tgl_dibuat)) ?></td>
                </tr>
            <?php endforeach; ?>
    </table>
    <p style="font-size:x-small;text-align:right">Dicetak pada: <?= tanggal_indonesia(date('Y-m-d')) ?></p>

</body>

</html>