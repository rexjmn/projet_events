<section class="flex justify-center items-center min-h-screen">
    <form action="?page=login" method="post" class="flex flex-col gap-5 w-full max-w-md p-8 bg-black/50 backdrop-blur-md rounded-lg border border-gray-800">
        <div class="text-center mb-6">
            <h1 class="text-5xl text-white font-bold pb-6 border-b border-gray-700" data-aos="fade-up">Se connecter</h1>
        </div>
        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="bg-red-500/20 text-red-200 p-3 rounded" data-aos="fade-up">
                <?= htmlspecialchars($_SESSION['error_message']); unset($_SESSION['error_message']); ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="bg-green-500/20 text-green-200 p-3 rounded" data-aos="fade-up">
                <?= htmlspecialchars($_SESSION['success_message']); unset($_SESSION['success_message']); ?>
            </div>
        <?php endif; ?>
        <input 
            placeholder="Email" 
            type="email" 
            name="email" 
            required 
            class="w-full px-4 py-3 rounded bg-white/90 text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition-all" 
            data-aos="fade-up" 
            data-aos-delay="200"
        >
        <input 
            placeholder="Mot de passe" 
            type="password" 
            name="password" 
            required 
            class="w-full px-4 py-3 rounded bg-white/90 text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition-all" 
            data-aos="fade-up" 
            data-aos-delay="300"
        >
        <button 
            class="mt-4 bg-yellow-500 text-black py-3 rounded-xl font-semibold hover:bg-yellow-400 transition-colors" 
            type="submit" 
            data-aos="fade-up" 
            data-aos-delay="400"
        >
            Se connecter
        </button>
        <p class="text-center text-gray-400 mt-4" data-aos="fade-up" data-aos-delay="500">
            Pas encore de compte ? <a href="?page=signup" class="text-yellow-500 hover:text-yellow-400">Inscrivez-vous</a>
        </p>
    </form>
</section>