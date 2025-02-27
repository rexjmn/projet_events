<section class="flex justify-center items-center min-h-screen p-6">
    <div class="w-full max-w-4xl bg-black/50 backdrop-blur-md rounded-lg border border-gray-800 p-8">
        <h1 class="text-4xl text-white font-bold mb-8 text-center border-b border-gray-700 pb-4">Gestion des Lieux</h1>

        <!-- Mensajes de sesión -->
        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="bg-red-500/20 text-red-200 p-3 rounded mb-4">
                <?= htmlspecialchars($_SESSION['error_message']); unset($_SESSION['error_message']); ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="bg-green-500/20 text-green-200 p-3 rounded mb-4">
                <?= htmlspecialchars($_SESSION['success_message']); unset($_SESSION['success_message']); ?>
            </div>
        <?php endif; ?>

        <!-- Formulario de agregar/modificar lugar -->
        <form action="?page=lieux" method="post" class="space-y-6">
            <input type="hidden" name="action" id="form_action" value="add">
            <input type="hidden" name="id_lieu" id="id_lieu">
            
            <div class="space-y-4">
                <div>
                    <label class="block text-white mb-2">Nom du lieu</label>
                    <input 
                        type="text" 
                        name="nom_lieu" 
                        id="nom_lieu"
                        class="w-full px-4 py-3 rounded bg-white/90 text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition-all"
                        required
                    >
                </div>

                <div>
                    <label class="block text-white mb-2">Adresse</label>
                    <textarea 
                        name="adresse" 
                        id="adresse"
                        rows="3"
                        class="w-full px-4 py-3 rounded bg-white/90 text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition-all"
                        required
                    ></textarea>
                </div>

                <div>
                    <label class="block text-white mb-2">Code Postal</label>
                    <input 
                        type="text" 
                        name="code_postal"
                        id="code_postal"
                        class="w-full px-4 py-3 rounded bg-white/90 text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition-all"
                        required
                    >
                </div>
            </div>

            <div class="flex justify-end gap-4">
                <button 
                    type="reset"
                    class="px-6 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition-colors"
                    onclick="resetForm()"
                >
                    Annuler
                </button>
                <button 
                    type="submit"
                    class="px-6 py-2 bg-yellow-500 text-black rounded hover:bg-yellow-400 transition-colors"
                >
                    Enregistrer
                </button>
            </div>
        </form>

        <!-- Tabla de lugares -->
        <div class="mt-12">
            <h2 class="text-2xl text-white mb-6">Liste des lieux</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-white">
                    <thead class="bg-gray-800">
                        <tr>
                            <th class="px-6 py-3 text-left">Nom du lieu</th>
                            <th class="px-6 py-3 text-left">Adresse</th>
                            <th class="px-6 py-3 text-left">Code Postal</th>
                            <th class="px-6 py-3 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        <?php foreach ($lieux as $lieu): ?>
                            <tr class="hover:bg-gray-700">
                                <td class="px-6 py-4"><?= htmlspecialchars($lieu["nom_lieu"]) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($lieu["adresse"]) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($lieu["code_postal"]) ?></td>
                                <td class="px-6 py-4">
                                    <button 
                                        onclick="editLieu(<?= $lieu['id_lieu'] ?>, '<?= addslashes($lieu['nom_lieu']) ?>', '<?= addslashes($lieu['adresse']) ?>', '<?= $lieu['code_postal'] ?>')" 
                                        class="text-blue-400 hover:text-blue-300 mr-2"
                                    >
                                        Modifier
                                    </button>
                                    <a href="?page=lieux&delete=<?= $lieu['id_lieu'] ?>" 
                                       class="text-red-400 hover:text-red-300"
                                       onclick="return confirm('Voulez-vous vraiment supprimer ce lieu ?');">
                                        Supprimer
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<script>
    function editLieu(id, nom_lieu, adresse, code_postal) {
        document.getElementById('id_lieu').value = id;
        document.getElementById('nom_lieu').value = nom_lieu;
        document.getElementById('adresse').value = adresse;
        document.getElementById('code_postal').value = code_postal;
        document.getElementById('form_action').value = 'edit';
    }

    function resetForm() {
        document.getElementById('id_lieu').value = '';
        document.getElementById('nom_lieu').value = '';
        document.getElementById('adresse').value = '';
        document.getElementById('code_postal').value = '';
        document.getElementById('form_action').value = 'add';
    }
</script>