{{-- بنطبّق الوضع الداكن قبل ما تترسم الصفحة، عشان ما تصير وميضة (flash) بالألوان --}}
<script>
    (function () {
        var stored = localStorage.getItem('theme');
        var prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        var isDark = stored ? stored === 'dark' : prefersDark;
        document.documentElement.classList.toggle('dark', isDark);
    })();
</script>
