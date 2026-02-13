<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mainview | Students OJT </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.2/themes/base/jquery-ui.css">
</head>
<body>
    <main>
        <aside id="sidebar" class="w-72 bg-white border-r border-gray-100 flex flex-col sticky top-0 h-screen shrink-0">
            <section class="p-8">
                <h1 class="text-2xl font-serif font-bold text-ethereal tracking-tight"> Café Ethereal</h1>
                <p class="text-[10px] uppercase tracking-widest text-gray-400 mt-1 font-bold">Admin Console</p>
            </section>

            <nav class="flex-1 px-4 space-y-2">
                <a href="#" class="nav-link active" data-page="dashboard">
                    <i class="fas fa-chart-pie w-5 text-center"></i> Dashboard
                </a>
                <a href="#" class="nav-link" data-page="employee">
                    <i class="fas fa-users w-5 text-center"></i> Employees
                </a>
                <a href="#" class="nav-link" data-page="attendance">
                    <i class="fas fa-clock w-5 text-center"></i> Attendance 
                </a>
                <a href="#" class="nav-link" data-page="payroll">
                    <i class="fas fa-money-bill-wave w-5 text-center"></i> Payroll Batches
                </a>

                <a href="#" class="nav-link" data-page="report">
                    <i class="fas fa-line-chart w-5 text-center"></i> Report
                </a>

                <a href="#" class="nav-link" data-page="setting">
                    <i class="fas fa-cog w-5 text-center"></i> Settings
                </a>
            </nav>

            <section class="p-6 mt-auto border-t border-gray-50">
                <div class="bg-gray-50 rounded-2xl p-4 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-ethereal flex items-center justify-center text-white font-serif shadow-sm">A</div>
                    <div class="overflow-hidden">
                        <p class="text-sm font-bold truncate text-gray-900">Admin Manager</p>
                        <p class="text-[10px] text-gray-400 uppercase tracking-tighter font-bold">Full Access</p>
                    </div>
                </div>
            </section>
        </aside>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>