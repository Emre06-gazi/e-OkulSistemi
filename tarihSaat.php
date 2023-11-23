<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saat ve Takvim</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
            text-align: center;
        }

        h1 {
            color: #333;
        }

        #clock {
            font-size: 2em;
            color: #333;
        }

        #calendar {
            margin-top: 20px;
            border-collapse: collapse;
            width: 70%;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: auto;
        }

        #calendar th,
        #calendar td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: center;
        }

        #calendar th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div id="clock"></div>

    <table id="calendar">
        <thead>
            <tr>
                <th>Paz</th>
                <th>Pzt</th>
                <th>Sal</th>
                <th>Çar</th>
                <th>Per</th>
                <th>Cum</th>
                <th>Cmt</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
            $currentDay = date('j');

            $dayOfMonth = 1;
            $dayOfWeek = date('N', strtotime(date('Y-m-01')));

            echo "<tr>";

            for ($i = 1; $i < $dayOfWeek; $i++) {
                echo "<td></td>";
            }

            while ($dayOfMonth <= $daysInMonth) {
                if ($dayOfWeek > 7) {
                    echo "</tr><tr>";
                    $dayOfWeek = 1;
                }

                echo "<td" . (($dayOfMonth == $currentDay) ? " style='background-color: #a7d8a8;'" : "") . ">$dayOfMonth</td>";

                $dayOfMonth++;
                $dayOfWeek++;
            }

            echo "</tr>";
            ?>
        </tbody>
    </table>

    <script>
        function updateClock() {
            var now = new Date();
            var hours = now.getHours();
            var minutes = now.getMinutes();
            var seconds = now.getSeconds();

            hours = (hours < 10) ? "0" + hours : hours;
            minutes = (minutes < 10) ? "0" + minutes : minutes;
            seconds = (seconds < 10) ? "0" + seconds : seconds;

            var timeString = hours + ":" + minutes + ":" + seconds;
            document.getElementById("clock").innerHTML = timeString;

            setTimeout(updateClock, 1000);
        }

        updateClock();
    </script>
</body>

</html>
