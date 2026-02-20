<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Preview</title>
</head>

<body>

    <main>
        <section>
            <h1>Attendance Report</h1>
            <table border="1" with="100%" cellpadding="5">
                <th>
                    <tr>Name</tr>
                    <tr>Date </tr>
                    <tr>Time-In</tr>
                    <tr>Time-out</tr>
                    <tr>Status</tr>
                    <tbody>
                        <?php foreach ($attandance as $data) { ?>
                            <tr><?php esc($data["firstName"] + " " + $data["lastName"]) ?></tr>
                            <tr><?php esc($data["date"]) ?></tr>
                            <tr><?php esc($data["timeIn"]) ?></tr>
                            <tr><?php esc($data["timeOut"]) ?></tr>
                            <tr><?php esc($data["status"]) ?></tr>
                        <?php } ?>
                    </tbody>
                </th>
            </table>
        </section>
    </main>

</body>

</html>