@if (session('success') || session('error') || session('info'))
    <style>
        .alert-float {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 999999;
            min-width: 300px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            animation: fadeInUp 0.5s ease forwards;
            transition: all 0.5s ease;
            opacity: 1;
        }

        .alert-float.hide {
            opacity: 0;
            transform: translateY(-20px);
        }

        .alert {
            margin-bottom: 10px;
            padding: 15px 18px;
            border: none;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 15px;
            font-weight: 500;
        }

        .alert-success {
            background: linear-gradient(45deg, #28a745, #34ce57);
        }

        .alert-danger {
            background: linear-gradient(45deg, #dc3545, #ff5c75);
        }

        .alert-info {
            background: linear-gradient(45deg, #007bff, #33b5e5);
        }

        .alert button.close {
            background: transparent;
            border: none;
            color: #fff;
            font-size: 22px;
            line-height: 1;
            cursor: pointer;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <div class="alerts-wrapper">
        @if (session('success'))
            <div class="alert alert-success alert-float" role="alert">
                ✅ {{ session('success') }}
                <button type="button" class="close" aria-label="Close">&times;</button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-float" role="alert">
                ❌ {{ session('error') }}
                <button type="button" class="close" aria-label="Close">&times;</button>
            </div>
        @endif

        @if (session('info'))
            <div class="alert alert-info alert-float" role="alert">
                ℹ️ {{ session('info') }}
                <button type="button" class="close" aria-label="Close">&times;</button>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const alerts = document.querySelectorAll(".alert-float");
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.classList.add("hide");
                    setTimeout(() => alert.remove(), 500);
                }, 5000);

                alert.querySelector(".close").addEventListener("click", () => {
                    alert.classList.add("hide");
                    setTimeout(() => alert.remove(), 500);
                });
            });
        });
    </script>
@endif
