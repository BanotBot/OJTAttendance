<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mainview | Students OJT </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.2/themes/base/jquery-ui.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        ethereal: '#4518e4',
                        etherealDark: '#4518e4', 
                        bgWarm: '#F9F7F7',
                        surface: '#FFFFFF'
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    }
                }
            }
        };
    </script>

    <style type="style/tailwindcss">
        @layer base{
            body {
                @apply bg-warm font-sans text-gray-800 antialised;
            }

            ::-webkit-scrollbar: {
                width: 50px;    
            }

            ::-webkit-scrollbar-thumb { 
                @apply bg-ethereal rounded-full; 
            }

            @layer components {
                .nav-link { @apply 
                    flex items-center gap-4 px-4 py-3 text-gray-400 hover:bg-gray-50 hover:text-ethereal transition-all duration-200 rounded-xl font-medium;
                }
                .nav-link.active { @apply
                    bg-ethereal/10 text-ethereal font-semibold;
                }
            }
        }
    </style>
</head>
<body>

    <main class="flex min-h-screen">
        <aside id="sidebar" class="w-72 bg-white border-r border-gray-100 flex flex-col sticky top-0 h-screen shrink-0">
            <section class="p-8">
                <h1 class="text-2xl font-serif font-bold text-ethereal tracking-tight"> Students OJT </h1>
                <p class="text-[10px] uppercase tracking-widest text-gray-400 mt-1 font-bold">Students Console</p>
            </section>

            <nav class="flex-1 px-4 space-y-2">
                <a href="#" class="nav-link active" data-page="dashboard">
                    <i class="fas fa-chart-pie w-5 text-center"></i> Dashboard
                </a>
                <a href="#" class="nav-link" data-page="attendance">
                    <i class="fas fa-clock w-5 text-center"></i> Attendance 
                </a>
                <a href="#" class="nav-link" data-page="report">
                    <i class="fas fa-line-chart w-5 text-center"></i> Report
                </a>
            </nav>

            <section class="p-6 mt-auto border-t border-gray-50">
                <div class="bg-gray-50 rounded-2xl p-4 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-ethereal flex items-center justify-center text-white font-serif shadow-sm">A</div>
                    <div class="overflow-hidden">
                        <p class="text-sm font-bold truncate text-gray-900">Ivan Dave Besere</p>
                        <p class="text-[10px] text-gray-400 uppercase tracking-tighter font-bold">Full Access</p>
                    </div>
                </div>
            </section>
            
        </aside>
        <section id="main_content" class="flex-1 bg-bgWarm p-8 overflow-y-auto"></section>
    </main>

    <!-- Dependencies --> 
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.14.2/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
    <script>
        const BASE_URL = "<?php echo base_url("students_ojt/"); ?>";
        const SAVE_ATTENDANCE_URL = "<?php echo base_url("saveAttendance") ?>";
    </script>
    <script src="<?php echo base_url('js/dynamic_content_loading.js')?>"></script>
    <script src="<?php echo base_url('js/students_ojt/camera_attendance.js')?>"></script>

</body>
</html>