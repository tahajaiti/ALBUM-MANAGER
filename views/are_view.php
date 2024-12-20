<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mezikka - Purchase Confirmation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#fef2f2',
                            100: '#fee2e2',
                            200: '#fecaca',
                            300: '#fca5a5',
                            400: '#f87171',
                            500: '#ef4444',
                            600: '#dc2626',
                            700: '#b91c1c',
                            800: '#991b1b',
                            900: '#7f1d1d',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-gray-900 to-black text-gray-100">
    <div class="relative min-h-screen flex items-center justify-center px-4">
        <!-- Background pattern -->
        <div class="absolute inset-0 z-0 opacity-20">
            <div class="absolute inset-0 bg-repeat bg-center" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23FF0000\' fill-opacity=\'0.1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
            </div>
        </div>

        <!-- Pop-up -->
        <div id="purchasePopup" class="relative z-10 bg-gray-800 bg-opacity-70 backdrop-blur-md rounded-xl shadow-2xl p-8 max-w-md w-full opacity-0 scale-95">
            <h2 class="text-2xl font-bold text-primary-400 mb-4">Confirm Purchase</h2>
            <p class="text-gray-300 mb-6">Are you sure you want to buy this album?</p>
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h3 class="text-xl font-semibold text-primary-300">Neon Dreams</h3>
                    <p class="text-gray-400">by Electro Harmony</p>
                </div>
                <span class="text-2xl font-bold text-primary-400">$9.99</span>
            </div>
            <div class="flex space-x-4">
                <button id="confirmPurchase" class="flex-1 bg-primary-600 hover:bg-primary-700 text-white font-bold py-2 px-4 rounded-md transition duration-300 transform hover:-translate-y-1">
                    Confirm
                </button>
                <button id="cancelPurchase" class="flex-1 bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-md transition duration-300 transform hover:-translate-y-1">
                    Cancel
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const popup = document.getElementById('purchasePopup');
            
            // Animate popup appearance
            anime({
                targets: popup,
                opacity: [0, 1],
                scale: [0.95, 1],
                duration: 400,
                easing: 'easeOutCubic'
            });

            // Button hover animations
            const buttons = document.querySelectorAll('button');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', () => {
                    anime({
                        targets: button,
                        scale: 1.05,
                        duration: 300,
                        easing: 'easeOutCubic'
                    });
                });
                button.addEventListener('mouseleave', () => {
                    anime({
                        targets: button,
                        scale: 1,
                        duration: 300,
                        easing: 'easeOutCubic'
                    });
                });
            });

            // Confirm button click animation
            document.getElementById('confirmPurchase').addEventListener('click', () => {
                anime({
                    targets: popup,
                    opacity: 0,
                    scale: 0.95,
                    duration: 300,
                    easing: 'easeInCubic',
                    complete: () => {
                        // Redirect to purchase confirmation page
                        window.location.href = 'purchase-confirmation.html';
                    }
                });
            });

            // Cancel button click animation
            document.getElementById('cancelPurchase').addEventListener('click', () => {
                anime({
                    targets: popup,
                    opacity: 0,
                    scale: 0.95,
                    duration: 300,
                    easing: 'easeInCubic',
                    complete: () => {
                        // Close the popup or redirect as needed
                        popup.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>