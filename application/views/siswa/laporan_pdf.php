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
?>

<!DOCTYPE html>
<html><head>
    <title></title>
</head><body>
    <table>
        <thead>
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
            </tr>
        </thead>

        <tbody>
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
                    <td>
                        <?php echo predikat($key->nilai_1) ?>
                    </td>
                    <td>
                        <?php echo predikat($key->nilai_2) ?>
                    </td>
                    <td>
                        <?php echo predikat($key->nilai_3) ?>
                    </td>
                    <td>
                        <?php echo predikat($key->nilai_4) ?>
                    </td>
                    <td>
                        <?php echo predikat($key->nilai_5) ?>
                    </td>
                    <td>
                        <?php echo predikat($key->nilai_6) ?>
                    </td>
                </tr>
            <?php $no++; } ?>
        </tbody>
    </table>
</body></html>