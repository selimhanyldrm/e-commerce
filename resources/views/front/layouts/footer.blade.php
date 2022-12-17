<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-6">Nealsam.com &copy; 2022</div>
            <div class="col-md-6 text-right"><a href="http://www.uzaktankurs.com"></a></div>
        </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- Odeme Scriptleri -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
<script>
    $('.kredikarti').mask('0000-0000-0000-0000', { placeholder: "____-____-____-____" });
    $('.kredikarti_cvv').mask('000', { placeholder: "___" });
    $('.telefon').mask('(000) 000-00-00', { placeholder: "(___) ___-__-__" });
</script>

@yield('script')
</body>

</html>
