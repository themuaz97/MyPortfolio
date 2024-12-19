<?php
// Default values for dynamic content
$title = isset($title) ? $title : 'Default Modal Title';
$inputs = isset($inputs) ? $inputs : [];
$action = isset($action) ? $action : '#'; // Action URL (e.g., form submission URL)
$submitText = isset($submitText) ? $submitText : 'Submit';
?>

<div id="dynamicModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg p-6 max-w-sm w-full">
        <h3 class="text-xl font-semibold text-gray-800 mb-2"><?php echo $title; ?></h3>

        <!-- Dynamic Form -->
        <form action="<?php echo $action; ?>" method="POST">
            <?php foreach ($inputs as $input): ?>
                <div class="mb-2">
                    <label for="<?php echo $input['name']; ?>" class="block text-gray-700"><?php echo $input['label']; ?></label>
                    <input type="<?php echo $input['type']; ?>" id="<?php echo $input['name']; ?>" name="<?php echo $input['name']; ?>" 
                           class="w-full p-2 border border-gray-300 rounded-lg" required>
                </div>
            <?php endforeach; ?>

            <div class="flex justify-end">
                <button type="button" onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2">
                    Cancel
                </button>
                <button type="submit" class="bg-violet-600 text-white px-4 py-2 rounded-lg">
                    <?php echo $submitText; ?>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Open modal
    function openModal() {
        document.getElementById('dynamicModal').classList.remove('hidden');
    }

    // Close modal
    function closeModal() {
        document.getElementById('dynamicModal').classList.add('hidden');
    }
</script>
