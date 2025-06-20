<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>萬年曆</title>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }
        h1 {
            text-align: center;
            color: lightseagreen;
        }
        /* 容器：最大寬度 420px，置中 */
        .box-container {
            width: 100%;
            max-width: 420px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            box-sizing: border-box;
            padding: 1px 0 0 1px;
        }
        /* 星期標題 */
        .th-box {
            width: calc(100% / 7);
            height: 25px;
            text-align: center;
            line-height: 25px;
            background-color: lightblue;
            border: 1px solid blue;
            box-sizing: border-box;
            margin-left: -1px;
            margin-top: -1px;
        }
        /* 每天格子 */
        .box {
            width: calc(100% / 7);
            height: 80px;
            background-color: #f0f8ff;
            border: 1px solid blue;
            box-sizing: border-box;
            margin-left: -1px;
            margin-top: -1px;
            position: relative;
        }
        /* 今天 */
        .today {
            background-color: yellow;
            font-weight: bold;
        }
        /* 過去日期 */
        .pass-date {
            background-color: #f5f5f5;
            color: #aaa;
        }
        /* 日期區塊上方：日期號碼與週數 */
        .day-info {
            display: flex;
            justify-content: space-between;
            padding: 2px 4px;
        }
        .date-num {
            font-size: 14px;
            color: #999;
        }
        .day-week {
            font-size: 12px;
            color: #aaa;
        }
        /* 節日 */
        .holiday {
            font-size: 12px;
            color: #e60000;
            text-align: center;
            margin-top: 4px;
        }
        /* 待辦事項 */
        .todo {
            font-size: 12px;
            color: #000;
            text-align: center;
            margin-top: 2px;
        }
        /* 滑鼠懸停效果 */
        .box:hover {
            background-color: lightblue;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>萬年曆</h1>

    <?php
    // 取得當前或傳入的年月
    if (isset($_GET['month'])) {
        $month = (int) $_GET['month'];
    } else {
        $month = (int) date("m");
    }
    if (isset($_GET['year'])) {
        $year = (int) $_GET['year'];
    } else {
        $year = (int) date("Y");
    }

    // 計算上一個月
    if ($month - 1 > 0) {
        $prev = $month - 1;
        $prevyear = $year;
    } else {
        $prev = 12;
        $prevyear = $year - 1;
    }
    // 計算下一個月
    if ($month + 1 > 12) {
        $next = 1;
        $nextyear = $year + 1;
    } else {
        $next = $month + 1;
        $nextyear = $year;
    }

    // 當月第一天與天數、星期
    $firstDay = date("Y-$month-01");
    $firstDayWeek = (int) date("w", strtotime($firstDay)); // 0=日,1=一,...6=六
    $theDaysOfMonth = (int) date("t", strtotime($firstDay));

    // 節日與待辦事項陣列
    $spDate = [
        '2025-04-04' => '兒童節',
        '2025-04-05' => '清明節',
        '2025-05-01' => '勞動節',
        '2025-05-11' => '母親節',
        '2025-05-30' => '端午節',
        '2025-09-27' => '教師節',
        '2025-10-10' => '雙十節',
        '2025-11-26' => '生日'
    ];
    $todoList = [
        '2025-09-23' => '結訓'
    ];

    // 構建整個月的天數陣列
    $monthDays = [];
    // 補「上個月」的空格
    for ($i = 0; $i < $firstDayWeek; $i++) {
        $monthDays[] = [];
    }
    // 塞入本月每天
    for ($i = 0; $i < $theDaysOfMonth; $i++) {
        $timestamp = strtotime("{$i} days", strtotime($firstDay));
        $full = date("Y-m-d", $timestamp);
        $dayNum = date("d", $timestamp);
        $weekOfYear = date("W", $timestamp);
        $week = date("w", $timestamp);
        $daysOfYear = date("z", $timestamp);
        $workday = (date("N", $timestamp) < 6);

        // 節日
        $holiday = "";
        if (isset($spDate[$full])) {
            $holiday = $spDate[$full];
        }
        // 待辦
        $todo = "";
        if (isset($todoList[$full])) {
            $todo = $todoList[$full];
        }

        $monthDays[] = [
            "day"        => $dayNum,
            "fullDate"   => $full,
            "weekOfYear" => $weekOfYear,
            "week"       => $week,
            "daysOfYear" => $daysOfYear,
            "workday"    => $workday,
            "holiday"    => $holiday,
            "todo"       => $todo
        ];
    }
    ?>

    <!-- 上下月導覽 -->
    <div style="display: flex; width: 90%; max-width: 420px; margin: 0 auto; justify-content: space-between; align-items: center;">
        <a href="?year=<?php echo $prevyear; ?>&month=<?php echo $prev; ?>">&lt; 上個月</a>
        <h2 style="margin: 0;"><?php echo $year; ?> 年 <?php echo $month; ?> 月</h2>
        <a href="?year=<?php echo $nextyear; ?>&month=<?php echo $next; ?>">下一月 &gt;</a>
    </div>
    <br>

    <!-- 星期列 -->
    <div class="box-container">
        <div class="th-box">日</div>
        <div class="th-box">一</div>
        <div class="th-box">二</div>
        <div class="th-box">三</div>
        <div class="th-box">四</div>
        <div class="th-box">五</div>
        <div class="th-box">六</div>
    </div>

    <!-- 日曆主體 -->
    <div class="box-container">
        <?php
        $todayDate = date("Y-m-d");
        foreach ($monthDays as $day) {
            // 如果欄位是空陣列，表示該格沒有任何日期
            if (empty($day)) {
                echo "<div class='box'></div>";
                continue;
            }
            // 判斷是否為今天
            $full = $day['fullDate'];
            $isToday = ($full === $todayDate);
            // 判斷是否為過去日期
            $isPast = ($full < $todayDate);

            // 套用 class
            $classes = "box";
            if ($isToday) {
                $classes .= " today";
            } elseif ($isPast) {
                $classes .= " pass-date";
            }

            echo "<div class='{$classes}'>";
                // 日期號碼 與 週數
                echo "<div class='day-info'>";
                    echo "<div class='date-num'>{$day['day']}</div>";
                    echo "<div class='day-week'>{$day['weekOfYear']}</div>";
                echo "</div>";

                // 節日
                if (!empty($day['holiday'])) {
                    echo "<div class='holiday'>{$day['holiday']}</div>";
                } else {
                    echo "<div style='height:16px;'>&nbsp;</div>";
                }

                // 待辦
                if (!empty($day['todo'])) {
                    echo "<div class='todo'>{$day['todo']}</div>";
                } else {
                    echo "<div style='height:14px;'>&nbsp;</div>";
                }
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
