<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Preview</title>
</head>

<style>
    :root {
        font-family: Arial, Helvetica, sans-serif;
    }
    
    h1 {
        padding: 0 0 50px 0;
    }

    table {
        width: 100%;
        border-color: 1px #0000;
        border-collapse: collapse;
        table-layout: fixed;
        justify-content: center;
        text-align: center;
    }

    th,
    td {
        border: 1px solid #0000;
        padding: 8px;
        text-align: left;
        word-wrap: break-word;
        row-gap: 40px;
    }

    td {
        font-size: 1.4em;
    }
</style>

<body>

    <main>
        <section>
            <h1>OJT Attendance Report</h1>
            <table borders="1">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Time-In</th>
                        <th>Time-out</th>
                        <th>Status</th>
                        <th>Signature</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($attendance as $data) { ?>
                        <tr>
                            <td><?php echo esc($data["firstname"] . " " . $data["lastname"]) ?></td>
                            <td><?php echo esc($data["date"]) ?></td>
                            <td><?php echo esc(AttendanceHelper::get_status($data["timeIn"])) ?></td>
                            <td><?php echo esc(AttendanceHelper::get_time_12Hour_format($data["timeOut"])) ?></td>
                            <td><?php echo esc(AttendanceHelper::get_status($data["status"])) ?></td>
                            <td></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>