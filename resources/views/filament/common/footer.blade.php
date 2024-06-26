{{-- <footer class="fixed bottom-0 left-0 z-20 w-full p-4 bg-white border-t border-gray-200 shadow md:flex md:items-center md:justify-between md:p-6 dark:bg-gray-800 dark:border-gray-600">
    <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023
        <a href="#" class="hover:underline">Your Site™</a>. All Rights Reserved.
    </span>
</footer> --}}
<footer class="relative z-20 w-full p-4 bg-white border-t border-gray-200 shadow md:flex md:items-center md:justify-between md:p-6 dark:bg-gray-800 dark:border-gray-600">
    <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400" style="text-align: center;">
        © <span id="currentYear">2023</span>
        <a href="#" class="hover:underline">Developed By Innovix Matrix Systems™</a>. All Rights Reserved.
    </span>
</footer>

<script>
    document.getElementById("currentYear").innerHTML = new Date().getFullYear();
</script>

<!-- BotMan Widget 
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/assets/css/chat.min.css">-->
<script>
   var botmanWidget = {
        title: "Chatbot BiC&T", // Título personalizado
        introMessage: "Bem-vind@! 👋 Escreva 'oi' para começar.",
        bubbleAvatarUrl: "/assets/logo.jpg", // URL relativa para a imagem em public/assets/logo.svg
        customStylesheet: '/css/botman.css' // Referência ao arquivo CSS personalizado
    };
</script>
<script src="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js"></script>