 @extends('layouts.master')
 @section('content')
     <!-- Main Content -->
     <main class="main-content" id="mainContent">
         <!-- Top Bar -->
         <div class="top-bar">
             <div class="welcome-text">
                 <h2>Admin Dashboard</h2>
                 <p>System Overview & Management</p>
             </div>
             <div class="user-profile">
                 <div class="top-actions">
                     <button class="action-btn">
                         <i class="bi bi-bell"></i>
                         <span class="action-badge">12</span>
                     </button>
                     <button class="action-btn">
                         <i class="bi bi-gear"></i>
                     </button>
                 </div>
                 <div class="user-avatar">AD</div>
             </div>
         </div>

         <!-- Stats Cards -->
         <div class="stats-grid">
             <div class="stat-card primary">
                 <div class="stat-header">
                     <div class="stat-icon primary">
                         <i class="bi bi-people"></i>
                     </div>
                 </div>
                 <div class="stat-value">
                     <h3>2,847</h3>
                     <p class="stat-label">Total Users</p>
                     <div class="stat-change positive">
                         <i class="bi bi-arrow-up"></i>
                         <span>+15.2% this month</span>
                     </div>
                 </div>
             </div>

             <div class="stat-card success">
                 <div class="stat-header">
                     <div class="stat-icon success">
                         <i class="bi bi-cash-stack"></i>
                     </div>
                 </div>
                 <div class="stat-value">
                     <h3>$1.2M</h3>
                     <p class="stat-label">Total Investments</p>
                     <div class="stat-change positive">
                         <i class="bi bi-arrow-up"></i>
                         <span>+22.8% this month</span>
                     </div>
                 </div>
             </div>

             <div class="stat-card warning">
                 <div class="stat-header">
                     <div class="stat-icon warning">
                         <i class="bi bi-hourglass-split"></i>
                     </div>
                 </div>
                 <div class="stat-value">
                     <h3>8</h3>
                     <p class="stat-label">Pending Approvals</p>
                     <div class="stat-change">
                         <i class="bi bi-dash"></i>
                         <span>Requires attention</span>
                     </div>
                 </div>
             </div>

             <div class="stat-card danger">
                 <div class="stat-header">
                     <div class="stat-icon danger">
                         <i class="bi bi-graph-up-arrow"></i>
                     </div>
                 </div>
                 <div class="stat-value">
                     <h3>$128K</h3>
                     <p class="stat-label">Total Profits Paid</p>
                     <div class="stat-change positive">
                         <i class="bi bi-arrow-up"></i>
                         <span>+18.5% this month</span>
                     </div>
                 </div>
             </div>

             <div class="stat-card info">
                 <div class="stat-header">
                     <div class="stat-icon info">
                         <i class="bi bi-check-circle"></i>
                     </div>
                 </div>
                 <div class="stat-value">
                     <h3>1,245</h3>
                     <p class="stat-label">Active Investments</p>
                     <div class="stat-change positive">
                         <i class="bi bi-arrow-up"></i>
                         <span>+12.3% this week</span>
                     </div>
                 </div>
             </div>
         </div>

         <!-- Charts Row -->
         <div class="row mb-4">
             <div class="col-lg-8 mb-4">
                 <div class="chart-container">
                     <div class="chart-header">
                         <h3>Investment & Profit Trends</h3>
                         <div class="chart-filter">
                             <button class="filter-btn active">7D</button>
                             <button class="filter-btn">1M</button>
                             <button class="filter-btn">3M</button>
                             <button class="filter-btn">1Y</button>
                         </div>
                     </div>
                     <canvas id="trendsChart"></canvas>
                 </div>
             </div>

             <div class="col-lg-4 mb-4">
                 <div class="chart-container">
                     <div class="chart-header">
                         <h3>Investment Status</h3>
                     </div>
                     <canvas id="statusChart"></canvas>
                 </div>
             </div>
         </div>

         <!-- Pending Approvals Section -->
         <div class="table-container mb-4">
             <div class="table-header">
                 <h3><i class="bi bi-hourglass-split me-2"></i>Pending Approvals (8)</h3>
             </div>
         </div>

         <div class="pending-grid">
             <!-- Pending Card 1 -->
             <div class="pending-card">
                 <div class="pending-header">
                     <div class="user-info">
                         <div class="user-avatar-small">JD</div>
                         <div>
                             <strong>John Doe</strong>
                             <p class="text-muted small mb-0">john.doe@email.com</p>
                         </div>
                     </div>
                     <div class="pending-amount">$5,000</div>
                 </div>
                 <div class="pending-details">
                     <div class="detail-row">
                         <span class="detail-label">Date Submitted:</span>
                         <span>Nov 21, 2025 10:30 AM</span>
                     </div>
                     <div class="detail-row">
                         <span class="detail-label">Account:</span>
                         <span>****4521</span>
                     </div>
                     <div class="detail-row">
                         <span class="detail-label">Bank:</span>
                         <span>Chase Bank</span>
                     </div>
                 </div>
                 <img src="https://images.unsplash.com/photo-1554224311-beee460c201f?w=400&h=300&fit=crop" alt="Receipt"
                     class="receipt-preview" onclick="viewReceipt(this.src)">
                 <div class="action-buttons">
                     <button class="btn-approve" onclick="approveInvestment('JD', '$5,000')">
                         <i class="bi bi-check-circle"></i>
                         Approve
                     </button>
                     <button class="btn-reject" onclick="rejectInvestment('JD', '$5,000')">
                         <i class="bi bi-x-circle"></i>
                         Reject
                     </button>
                 </div>
             </div>

             <!-- Pending Card 2 -->
             <div class="pending-card">
                 <div class="pending-header">
                     <div class="user-info">
                         <div class="user-avatar-small">SM</div>
                         <div>
                             <strong>Sarah Miller</strong>
                             <p class="text-muted small mb-0">sarah.m@email.com</p>
                         </div>
                     </div>
                     <div class="pending-amount">$3,500</div>
                 </div>
                 <div class="pending-details">
                     <div class="detail-row">
                         <span class="detail-label">Date Submitted:</span>
                         <span>Nov 21, 2025 09:15 AM</span>
                     </div>
                     <div class="detail-row">
                         <span class="detail-label">Account:</span>
                         <span>****7892</span>
                     </div>
                     <div class="detail-row">
                         <span class="detail-label">Bank:</span>
                         <span>Bank of America</span>
                     </div>
                 </div>
                 <img src="https://images.unsplash.com/photo-1579621970795-87facc2f976d?w=400&h=300&fit=crop"
                     alt="Receipt" class="receipt-preview" onclick="viewReceipt(this.src)">
                 <div class="action-buttons">
                     <button class="btn-approve" onclick="approveInvestment('SM', '$3,500')">
                         <i class="bi bi-check-circle"></i>
                         Approve
                     </button>
                     <button class="btn-reject" onclick="rejectInvestment('SM', '$3,500')">
                         <i class="bi bi-x-circle"></i>
                         Reject
                     </button>
                 </div>
             </div>

             <!-- Pending Card 3 -->
             <div class="pending-card">
                 <div class="pending-header">
                     <div class="user-info">
                         <div class="user-avatar-small">MJ</div>
                         <div>
                             <strong>Michael Johnson</strong>
                             <p class="text-muted small mb-0">m.johnson@email.com</p>
                         </div>
                     </div>
                     <div class="pending-amount">$10,000</div>
                 </div>
                 <div class="pending-details">
                     <div class="detail-row">
                         <span class="detail-label">Date Submitted:</span>
                         <span>Nov 20, 2025 04:45 PM</span>
                     </div>
                     <div class="detail-row">
                         <span class="detail-label">Account:</span>
                         <span>****3321</span>
                     </div>
                     <div class="detail-row">
                         <span class="detail-label">Bank:</span>
                         <span>Wells Fargo</span>
                     </div>
                 </div>
                 <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=400&h=300&fit=crop"
                     alt="Receipt" class="receipt-preview" onclick="viewReceipt(this.src)">
                 <div class="action-buttons">
                     <button class="btn-approve" onclick="approveInvestment('MJ', '$10,000')">
                         <i class="bi bi-check-circle"></i>
                         Approve
                     </button>
                     <button class="btn-reject" onclick="rejectInvestment('MJ', '$10,000')">
                         <i class="bi bi-x-circle"></i>
                         Reject
                     </button>
                 </div>
             </div>
         </div>

         <!-- User Management Table -->
         <div class="table-container">
             <div class="table-header">
                 <h3>User Management</h3>
                 <div class="search-box">
                     <i class="bi bi-search"></i>
                     <input type="text" placeholder="Search users...">
                 </div>
             </div>
             <div class="table-responsive">
                 <table>
                     <thead>
                         <tr>
                             <th>User ID</th>
                             <th>Name</th>
                             <th>Email</th>
                             <th>Total Investment</th>
                             <th>Total Earnings</th>
                             <th>Join Date</th>
                             <th>Status</th>
                             <th>Actions</th>
                         </tr>
                     </thead>
                     <tbody>
                         <tr>
                             <td>#USR-1001</td>
                             <td>John Doe</td>
                             <td>john.doe@email.com</td>
                             <td>$45,280</td>
                             <td>$4,892</td>
                             <td>Jan 15, 2025</td>
                             <td><span class="status-badge active">Active</span></td>
                             <td>
                                 <button class="action-icon"><i class="bi bi-eye"></i></button>
                                 <button class="action-icon"><i class="bi bi-pencil"></i></button>
                                 <button class="action-icon"><i class="bi bi-trash"></i></button>
                             </td>
                         </tr>
                         <tr>
                             <td>#USR-1002</td>
                             <td>Sarah Miller</td>
                             <td>sarah.m@email.com</td>
                             <td>$32,500</td>
                             <td>$3,250</td>
                             <td>Feb 20, 2025</td>
                             <td><span class="status-badge active">Active</span></td>
                             <td>
                                 <button class="action-icon"><i class="bi bi-eye"></i></button>
                                 <button class="action-icon"><i class="bi bi-pencil"></i></button>
                                 <button class="action-icon"><i class="bi bi-trash"></i></button>
                             </td>
                         </tr>
                         <tr>
                             <td>#USR-1003</td>
                             <td>Michael Johnson</td>
                             <td>m.johnson@email.com</td>
                             <td>$78,900</td>
                             <td>$7,890</td>
                             <td>Jan 08, 2025</td>
                             <td><span class="status-badge active">Active</span></td>
                             <td>
                                 <button class="action-icon"><i class="bi bi-eye"></i></button>
                                 <button class="action-icon"><i class="bi bi-pencil"></i></button>
                                 <button class="action-icon"><i class="bi bi-trash"></i></button>
                             </td>
                         </tr>
                         <tr>
                             <td>#USR-1004</td>
                             <td>Emma Wilson</td>
                             <td>emma.w@email.com</td>
                             <td>$15,600</td>
                             <td>$1,560</td>
                             <td>Mar 12, 2025</td>
                             <td><span class="status-badge inactive">Inactive</span></td>
                             <td>
                                 <button class="action-icon"><i class="bi bi-eye"></i></button>
                                 <button class="action-icon"><i class="bi bi-pencil"></i></button>
                                 <button class="action-icon"><i class="bi bi-trash"></i></button>
                             </td>
                         </tr>
                         <tr>
                             <td>#USR-1005</td>
                             <td>David Brown</td>
                             <td>d.brown@email.com</td>
                             <td>$52,300</td>
                             <td>$5,230</td>
                             <td>Feb 05, 2025</td>
                             <td><span class="status-badge active">Active</span></td>
                             <td>
                                 <button class="action-icon"><i class="bi bi-eye"></i></button>
                                 <button class="action-icon"><i class="bi bi-pencil"></i></button>
                                 <button class="action-icon"><i class="bi bi-trash"></i></button>
                             </td>
                         </tr>
                     </tbody>
                 </table>
             </div>
         </div>
     </main>
 @endsection
