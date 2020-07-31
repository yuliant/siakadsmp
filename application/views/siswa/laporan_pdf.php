<?php
function predikat($nilai)
{
    if ($nilai <= 100 || $nilai > 89) {
        return "A";
    } elseif ($nilai <= 89 || $nilai > 79) {
        return "B";
    } elseif ($nilai <= 79 || $nilai > 69) {
        return "C";
    } elseif ($nilai <= 69 || $nilai > 59) {
        return "D";
    } else {
        return "E";
    }
}

function comulative_value($nilai1, $nilai2, $nilai3, $nilai4, $nilai5, $nilai6)
{
    return ($nilai1 + $nilai2 + $nilai3 + $nilai4 + $nilai5 + $nilai6) / 6;
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laporan</title>
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .line-title {
            border: 0;
            border-style: inset;
            border-top: 1px solid #000;
        }
    </style>
</head>

<body>
    <table style="width: 100%;">
        <tr>
            <td align="center">
                <span style="line-height: 1.6; font-weight: bold;">
                    SMPN 2 KREMBUNG SIDOARJO
                    <br>JAWA TIMUR INDONESIA
                </span>
            </td>
        </tr>
    </table>

    <hr class="line-title">
    <p align="center">
        LAPORAN NILAI SISWA <br>
        <b><?php echo $nama ?></b>
    </p>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Tahun Pelajaran</th>
            <th>Mata Pelajaran</th>
            <th>Kelas</th>
            <th>Semester</th>
            <th>Guru Pengajar</th>
            <th>Nilai 1</th>
            <th>Nilai 2</th>
            <th>Nilai 3</th>
            <th>Nilai 4</th>
            <th>Nilai 5</th>
            <th>Nilai 6</th>
            <th>Nilai Komulatif</th>
        </tr>
        <?php $no = 1;
        foreach ($data as $key) { ?>
            <tr>
                <td>
                    <?php echo $no ?>
                </td>
                <td>
                    <?php echo $key->tapel ?>
                </td>
                <td>
                    <?php echo $key->nama_mapel ?>
                </td>
                <td>
                    <?php echo $key->nama_kelas . $key->sub_kelas ?>
                </td>
                <td>
                    <?php echo $key->semester ?>
                </td>
                <td>
                    <?php echo $key->nama_guru ?>
                </td>

                <!-- <td>
                    <?php echo predikat($key->nilai_1) ?>
                </td> -->
                <td><?php echo $key->nilai_1 ?></td>

                <!-- <td>
                    <?php echo predikat($key->nilai_2) ?>
                </td> -->
                <td><?php echo $key->nilai_2 ?></td>

                <!-- <td>
                    <?php echo predikat($key->nilai_3) ?>
                </td> -->
                <td><?php echo $key->nilai_3 ?></td>

                <!-- <td>
                    <?php echo predikat($key->nilai_4) ?>
                </td> -->
                <td><?php echo $key->nilai_4 ?></td>

                <!-- <td>
                    <?php echo predikat($key->nilai_5) ?>
                </td> -->
                <td><?php echo $key->nilai_5 ?></td>

                <!-- <td>
                    <?php echo predikat($key->nilai_6) ?>
                </td> -->
                <td><?php echo $key->nilai_6 ?></td>

                <td>
                    <?php echo predikat(comulative_value($key->nilai_1, $key->nilai_2, $key->nilai_3, $key->nilai_4, $key->nilai_5, $key->nilai_6)) ?>
                </td>
            </tr>
        <?php $no++;
        } ?>
    </table>

</body>

</html>