
<?php
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include 'header.php';
?>

<h1>صفحات القرآن الكريم</h1>

<div id="pageContainer">
    <input type="number" id="pageInput" placeholder="أدخل رقم الصفحة" min="1" max="604">
    <button onclick="navigateToPage()">انتقل</button>
    <div id="pageContent"></div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
// نفس الكود JavaScript الأصلي مع تعديلات بسيطة
var currentPage = 1;

function navigateToPage() {
    var pageInput = document.getElementById('pageInput');
    var page = parseInt(pageInput.value);
    if (isNaN(page) || page < 1 || page > 604) {
        alert('رقم الصفحة غير صحيح! يرجى إدخال رقم صفحة صحيح من 1 إلى 604.');
        return;
    }
    currentPage = page;
    loadPage();
}

function loadPage() {
    $('#pageContent').html('<p>جارِ التحميل...</p>');
    var imageUrl = "https://quran.ksu.edu.sa/png_big/" + currentPage + ".png";
    var image = '<img src="' + imageUrl + '" alt="صفحة القرآن الكريم">';
    
    $('#pageContent').html(image);
    var pagination = '<div class="pagination">' +
        (currentPage > 1 ? '<button onclick="loadPreviousPage()">الصفحة السابقة</button>' : '') +
        (currentPage < 604 ? '<button onclick="loadNextPage()">الصفحة التالية</button>' : '') +
        '</div>';
    
    $('#pageContent').append(pagination);
}

function loadPreviousPage() {
    if (currentPage > 1) {
        currentPage--;
        $('#pageInput').val(currentPage);
        loadPage();
    }
}

function loadNextPage() {
    if (currentPage < 604) {
        currentPage++;
        $('#pageInput').val(currentPage);
        loadPage();
    }
}

// تحميل الصفحة الأولى تلقائيًا
$(document).ready(function(){
    loadPage();
});
</script>

<?php include 'footer.php'; ?>
