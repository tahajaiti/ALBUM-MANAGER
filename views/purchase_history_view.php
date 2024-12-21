<<?php
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php?view=register");
        exit();
    }
?>

<main>
    <section class="mt-8 p-16">
        <h2 class="text-3xl font-bold mb-6">Purchase History</h2>
        <div class="bg-gray-800/50 backdrop-blur-xl rounded-sm overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-700/50 backdrop-blur-md">
                        <th class="px-6 py-3 text-left">Cover</th>
                        <th class="px-6 py-3 text-left">Title</th>
                        <th class="px-6 py-3 text-left">Purchased At</th>
                        <th class="px-6 py-3 text-left">Price</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                        
                </tbody>
            </table>
        </div>
    </section>
</main>

<script type="module" src="./dist/purchase_history.js"></script>