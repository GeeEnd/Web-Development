  <!--**********************************
            Nav header start
        ***********************************-->
        <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Hide BMIS Text</title>
<style>
    .nav-header {
        display: flex;
        align-items: center;
    }
    .hamburger {
        cursor: pointer;
    }
    .line {
        display: block;
        width: 25px;
        height: 3px;
        margin: 5px auto;
        background-color: black;
    }
</style>
</head>
<body>

<div class="nav-header">
    <img src="../images/partners.png" style="width: 50px; height: 50px; margin-right: 10px; margin-left: 10px; margin-top: 10px;" alt="photo">
    <span id="bmisText" style="color: black; font-size: 30px; margin-top: 10px;"><strong> BMIS</strong></span>
    <div class="nav-control">
        <div class="hamburger">
            <span class="line"></span><span class="line"></span><span class="line"></span>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var hamburger = document.querySelector('.hamburger');
        var bmisText = document.getElementById('bmisText');

        hamburger.addEventListener('click', function () {
            // Toggle the visibility of BMIS text
            bmisText.style.display = bmisText.style.display === 'none' ? 'block' : 'none';
        });
    });
</script>

</body>
</html>

        <!--**********************************
            Nav header end
        ***********************************-->