<section class="flex justify-center items-center min-h-screen p-6">
    <div class="w-full max-w-4xl bg-black/50 backdrop-blur-md rounded-lg border border-gray-800 p-8">
        <h1 class="text-4xl text-white font-bold mb-8 text-center border-b border-gray-700 pb-4">Gestion des Événements</h1>

        <!-- Formulaire d'ajout/modification -->
        <form action="?page=evenements" method="post" class="space-y-6">
            <input type="hidden" name="id_evenement" id="id_evenement">
            
            <div class="space-y-4">
                <div>
                    <label class="block text-white mb-2">Titre</label>
                    <input 
                        type="text" 
                        name="titre" 
                        class="w-full px-4 py-3 rounded bg-white/90 text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition-all"
                        required
                    >
                </div>

                <div>
                    <label class="block text-white mb-2">Description</label>
                    <textarea 
                        name="description" 
                        rows="4"
                        class="w-full px-4 py-3 rounded bg-white/90 text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition-all"
                        required
                    ></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-white mb-2">Date de début</label>
                        <input 
                            type="datetime-local" 
                            name="date_debut"
                            class="w-full px-4 py-3 rounded bg-white/90 text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition-all"
                            required
                        >
                    </div>

                    <div>
                        <label class="block text-white mb-2">Date de fin</label>
                        <input 
                            type="datetime-local" 
                            name="date_fin"
                            class="w-full px-4 py-3 rounded bg-white/90 text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition-all"
                            required
                        >
                    </div>
                </div>

                <div>
                    <label class="block text-white mb-2">Lieu</label>
                    <select 
                        name="id_lieu"
                        class="w-full px-4 py-3 rounded bg-white/90 text-black placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition-all"
                        required
                    >
                        <option value="">Sélectionnez un lieu</option>
                        <?php foreach ($lieux as $lieu): ?>
                            <option value="<?= $lieu['id_lieu'] ?>">
                                <?= htmlspecialchars($lieu['nom_lieu']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-4">
                <button 
                    type="reset"
                    class="px-6 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition-colors"
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

        <!-- Tableau des événements -->
        <div class="mt-12">
            <h2 class="text-2xl text-white mb-6">Liste des événements</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-white">
                    <thead class="bg-gray-800">
                        <tr>
                            <th class="px-6 py-3 text-left">Titre</th>
                            <th class="px-6 py-3 text-left">Date début</th>
                            <th class="px-6 py-3 text-left">Date fin</th>
                            <th class="px-6 py-3 text-left">Lieu</th>
                            <th class="px-6 py-3 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        <?php foreach ($evenements as $event): ?>
                            <tr class="hover:bg-gray-700">
                                <td class="px-6 py-4"><?= htmlspecialchars($event["titre"]) ?></td>
                                <td class="px-6 py-4"><?= date("d/m/Y H:i", strtotime($event["date_debut"])) ?></td>
                                <td class="px-6 py-4"><?= date("d/m/Y H:i", strtotime($event["date_fin"])) ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($event["nom_lieu"] ?? 'N/A') ?></td>
                                <td class="px-6 py-4">
                                    <!-- Botones de edición y eliminación -->
                                    <a href="?page=evenements&delete=<?= $event['id_evenement'] ?>" 
                                       class="text-red-400 hover:text-red-300"
                                       onclick="return confirm('Voulez-vous vraiment supprimer cet événement ?');">
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