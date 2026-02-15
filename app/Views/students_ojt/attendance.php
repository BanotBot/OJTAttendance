<style>
    /* 1. Layout & Containers */
    .emp-container {
        width: 100%;
    }

    .emp-header {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        margin-bottom: 3rem;
        gap: 1.5rem;
        margin-top: 0;
    }

    @media (min-width: 768px) {
        .emp-header { flex-direction: row; align-items: flex-end; }
    }

    /* 2. Typography */
    .page-title {
        font-family: 'Playfair Display', serif;
        font-size: 3rem;
        color: #111827;
        line-height: 1.2;
    }

    .page-subtitle {
        color: #6B7280;
        margin-top: 0.5rem;
        font-style: italic;
        max-width: 28rem;
    }

    /* 3. Interactive Components (Buttons/Inputs) */
    .btn-group { display: flex; align-items: center; gap: 0.75rem; }

    .btn-primary {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.625rem 1.5rem;
        background-color: #4518e4;
        color: white;
        border-radius: 0.5rem;
        font-weight: 500;
        transition: all 0.3s;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    }

    .btn-primary:hover {
        background-color: #966D6D;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .btn-outline {
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: #4518e4;
        border: 1px solid rgba(179, 136, 136, 0.3);
        border-radius: 0.5rem;
        transition: background-color 0.2s;
    }

    .btn-outline:hover { background-color: rgba(179, 136, 136, 0.05); }

    
    /* Date Picker Container */
    .date-range-group {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background-color: #F9F7F7;
        padding: 0.25rem 0.75rem;
        border-radius: 0.5rem;
        border: 1px solid transparent;
        transition: all 0.2s;
    }

    .date-range-group:focus-within {
        background-color: white;
        border-color: #B38888;
        box-shadow: 0 0 0 1px #B38888;
    }

    .date-label {
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        color: #9CA3AF;
        letter-spacing: 0.05em;
    }

    .date-input {
        border: none;
        background: transparent;
        font-size: 0.875rem;
        color: #4B5563;
        font-family: inherit;
        outline: none;
        cursor: pointer;
    }

    .date-input::-webkit-calendar-picker-indicator {
        filter: invert(64%) sepia(10%) saturate(651%) hue-rotate(314deg) brightness(91%) contrast(88%);
        cursor: pointer;
    }

    .search-wrapper {
        position: relative;
        width: 18rem;
    }

    .search-input {
        width: 100%;
        padding: 0.5rem 1rem 0.5rem 2.5rem;
        font-size: 0.875rem;
        background-color: #F9F7F7;
        border-radius: 0.5rem;
        outline: none;
        transition: all 0.2s;
    }

    .search-input:focus {
        background-color: white;
        box-shadow: 0 0 0 1px #B38888;
    }

    .glass-card {
        background-color: white;
        border-radius: 1.5rem;
        border: 1px solid #F3F4F6;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        overflow: hidden;
    }

    .table-toolbar {
        padding: 1.5rem;
        border-bottom: 1px solid #F9FAFB;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .management-table {
        width: 100%;
        text-align: left;
        border-collapse: collapse;
    }

    .table-head-cell {
        padding: 1rem 1.5rem;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        color: #9CA3AF;
        background-color: rgba(249, 250, 251, 0.5);
    }

    .table-body-cell {
        padding: 1.25rem 1.5rem;
        font-size: 0.875rem;
        color: #4B5563;
        border-bottom: 1px solid #F9FAFB;
    }

    .row-hover:hover { background-color: #F9FAFB; }

    .status-chip {
        padding: 0.25rem 0.75rem;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        border-radius: 9999px;
        border: 1px solid transparent;
    }

    .active { background-color: #F0FDF4; color: #15803D; border-color: #DCFCE7; }
    .break { background-color: #FFFBEB; color: #B45309; border-color: #FEF3C7; }
    .off { background-color: #F9FAFB; color: #6B7280; border-color: #F3F4F6; }

    .table-footer {
        padding: 1.5rem;
        background-color: rgba(249, 250, 251, 0.3);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    @media (max-width: 768px) {
        .grid-layout { grid-template-columns: 1fr; }
        .span-2 { grid-column: span 1; }
    }
    
</style>

<section class="attendance-container">
    <div class="emp-container">
        <header class="emp-header">
            <section>
                <h1 class="page-title">Attendance Management</h1>
                <p class="page-subtitle">Manage your employee attendance.</p>
            </section>
        </header>

        <article class="glass-card">
            
            <div class="table-toolbar">
                <div class="flex items-center gap-4">
                    <div class="date-range-group">
                        <span class="date-label">From:</span>
                        <input type="date" class="date-input" name="start_date">
                        <span class="text-gray-300">|</span>
                        <span class="date-label">To:</span>
                        <input type="date" class="date-input" name="end_date">
                    </div>

                    <div class="search-wrapper">
                        <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </span>
                        <input type="text" placeholder="Search employee..." class="search-input">
                    </div>
                </div>
            </div>
            
            <table class="management-table">
                <thead>
                    <tr>
                        <th class="table-head-cell">Staff Member</th>
                        <th class="table-head-cell">Position</th>
                        <th class="table-head-cell">Rate per/hr </th>
                        <th class="table-head-cell">Overtime Date</th>
                        <th class="table-head-cell">Overtime End</th>
                        <th class="table-head-cell">Status</th>
                        <th class="table-head-cell text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="row-hover">
                        <td class="table-body-cell">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-[#B38888]/10 flex items-center justify-center text-[#966D6D] font-serif italic font-bold">A</div>
                                <div>
                                    <p class="font-semibold text-gray-900 leading-none">Amara Vance</p>
                                    <p class="text-[11px] text-gray-400 mt-1 italic">00023001</p>
                                </div>
                            </div>
                        </td>
                        <td class="table-body-cell font-medium">Head Roaster</td>
                        <td class="table-body-cell">38.5 hrs</td>
                        <td class="table-body-cell">Jan 06, 2026</td>
                        <td class="table-body-cell">02:00 PM</td>
                        <td class="table-body-cell"><span class="status-chip active">Absent</span></td>
                        <td class="table-body-cell text-right">
                            <button class="text-[#B38888] font-bold hover:text-[#966D6D] text-xs uppercase tracking-tighter">Profile</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <footer class="table-footer">
                <p class="text-[10px] text-gray-400 uppercase tracking-widest font-semibold">© 2026 Cafe Ethereal Systems</p>
                <div class="btn-group">
                    <button class="w-8 h-8 flex items-center justify-center rounded bg-white border border-gray-100 text-gray-400 hover:text-[#B38888]">1</button>
                    <button class="w-8 h-8 flex items-center justify-center rounded bg-white border border-gray-100 text-gray-400 hover:text-[#B38888]">2</button>
                </div>
            </footer>
        </article>
    </div>
</section>
