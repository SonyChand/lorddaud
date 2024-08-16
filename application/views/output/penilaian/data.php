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
                <th>Nama Siswa</th>
                <th>Mata Pelajaran</th>
                <th>Nilai</th>
                <th>Jenis Penilaian</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($data1 as $row) : ?>
                <?php
                $siswa = $this->db->get_where('siswa', ['id' => $row->id_siswa])->row();
                $matpel = $this->db->get_where('mata_pelajaran', ['id' => $row->id_matpel])->row();
                ?>
                <tr>
                    <th scope="row"><?= $i++ ?></th>
                    <td>
                        <?php if ($siswa) {
                            echo $siswa->nama . ' - ' . $siswa->nisn;
                        } else {
                            echo 'Belum ada';
                        } ?>
                    </td>
                    <td>
                        <?php if ($matpel) {
                            echo $matpel->nama . ' - ' . $matpel->kode;
                        } else {
                            echo 'Belum ada';
                        } ?>
                    </td>
                    <td><?= $row->nilai ?></td>
                    <td><?= $row->jenis_penilaian ?></td>
                </tr>
            <?php endforeach; ?>
    </table>
    <p style="font-size:x-small;text-align:right">Dicetak pada: <?= tanggal_indonesia(date('Y-m-d')) ?></p>

</body>

</html>