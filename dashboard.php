<?php
include('connection.php');


$sql_cardholders = "SELECT COUNT(*) as total_cardholders FROM FORM"; 
$result_cardholders = mysqli_query($conn, $sql_cardholders);
$row_cardholders = mysqli_fetch_assoc($result_cardholders);
$total_cardholders = $row_cardholders['total_cardholders'];

$sql_allottedSlots = "SELECT COUNT(*) as allotted_slots FROM slot_allocations"; 
$result_allottedSlots = mysqli_query($conn, $sql_allottedSlots);
$row_allottedSlots = mysqli_fetch_assoc($result_allottedSlots);
$total_allottedSlots = $row_allottedSlots['allotted_slots'];

$sql_collectedRation = "SELECT COUNT(*) as collected_ration FROM slot_allocations WHERE is_collected = 1";
$result_collectedRation = mysqli_query($conn, $sql_collectedRation);
$row_collectedRation = mysqli_fetch_assoc($result_collectedRation);
$collectedRation = $row_collectedRation['collected_ration'];

$sql_disabilities = "SELECT COUNT(*) as disabilities FROM FORM WHERE disability = 'Yes'";
$result_disabilities = mysqli_query($conn, $sql_disabilities);
$row_disabilities = mysqli_fetch_assoc($result_disabilities);
$total_disabilities = $row_disabilities['disabilities'];

$sql_seniorCitizens = "SELECT COUNT(*) as senior_citizens FROM FORM WHERE age > 60"; 
$result_seniorCitizens = mysqli_query($conn, $sql_seniorCitizens);
$row_seniorCitizens = mysqli_fetch_assoc($result_seniorCitizens);
$total_seniorCitizens = $row_seniorCitizens['senior_citizens'];

$sql_workingIndividuals = "SELECT COUNT(*) as working_individuals FROM FORM WHERE profession = 'Employed'"; 
$result_workingIndividuals = mysqli_query($conn, $sql_workingIndividuals);
$row_workingIndividuals = mysqli_fetch_assoc($result_workingIndividuals);
$total_workingIndividuals = $row_workingIndividuals['working_individuals'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ration Distribution System - Admin</title>
    <link rel="stylesheet" href="dashboard1.css">
</head>
<body>

    <header class="top-bar">
        <div class="logo-section">
            <img src="logo-png.png" alt="Logo" class="logo">
            <span class="app-name">Ration Distribution System</span>
        </div>
        <div class="search-section">
            <input type="text" placeholder="Search..." class="search-bar">
        </div>
        <div class="logout-section">
            <button class="logout-btn" onclick="logout()">Logout</button>
        </div>
    </header>

    <div class="container">
        
        <aside class="sidebar">
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="form.php">Manage Cardholders</a></li>
                <li><a href="creation.php">Slot Creation</a></li>
                <li><a href="allocation.php">Slot Allocation</a></li>
                <li><a href="viewslot.php">View Fields</a></li>
            </ul>
        </aside>

        
        <main class="main-content">
        <section class="image-slider">
                <div class="slider-container" id="sliderContainer">
                    <img src="5.png" alt="Image 1" class="slider-image">
                    <img src="2.png" alt="Image 2" class="slider-image">
                    <img src="3.png" alt="Image 3" class="slider-image">
                    <img src="4.jpg" alt="Image 4" class="slider-image">
                    <img src="1.png" alt="Image 5" class="slider-image">
                </div>
                <button class="prev-slide" onclick="prevSlide()">❮</button>
                <button class="next-slide" onclick="nextSlide()">❯</button>
            </section>

            <div class="floating-text">
                <marquee behavior="scroll" direction="left">
                    📢 New Circulars: The government has introduced updated ration distribution guidelines. Please check the guidelines section for details!
                </marquee>
            </div>

            
            <section class="stats">
                <div class="stat-box">
                    <h3>Number of Cardholders</h3>
                    <p id="cardholders"><?php echo $total_cardholders; ?></p>
                </div>
                <div class="stat-box">
                    <h3>Allotted Slots Today</h3>
                    <p id="allottedSlots"><?php echo $total_allottedSlots; ?></p>
                </div>
                <div class="stat-box">
                    <h3>Collected Rations (%)</h3>
                    <p id="collectedRation">
    <?php 
    if ($total_allottedSlots > 0) {
        echo round(($collectedRation / $total_allottedSlots) * 100, 2) . '%'; 
    } else {
        echo '0%'; 
    }
    ?>
</p>
                </div>
                <div class="stat-box">
                    <h3>People with Disabilities</h3>
                    <p id="disabilities"><?php echo $total_disabilities; ?></p>
                </div>
                <div class="stat-box">
                    <h3>Senior Citizens</h3>
                    <p id="seniorCitizens"><?php echo $total_seniorCitizens; ?></p>
                </div>
                <div class="stat-box">
                    <h3>Working Individuals</h3>
                    <p id="workingIndividuals"><?php echo $total_workingIndividuals; ?></p>
                </div>
            </section>

          
            <section class="charts">
                <div class="chart-container">
                    <h3>Monthly Trends</h3>
                    <canvas id="barChart"></canvas>
                </div>
                <div class="chart-container">
                    <h3>Cardholder Distribution</h3>
                    <canvas id="pieChart"></canvas>
                </div>
            </section>

           
            <section class="guidelines">
                <h3>Government Guidelines</h3>
                <p>Ensure that all cardholders are verified and allotted time slots to collect rations on time. Follow the standard operating procedures and guidelines as per the government:</p>
                <ul>
                    <li>Verification of ration cardholders is mandatory before allocation.</li>
                    <li>Priority slots must be given to senior citizens and differently-abled individuals.</li>
                    <li>Ensure that all rations are distributed within the monthly timeframe.</li>
                </ul>
            </section>

       
            <section class="circulars">
                <h3>Government Circulars</h3>
                <ul>
                    <li><strong>New Policy Update:</strong> Additional stock allocation for rural areas starting December 2024.</li>
                    <li><strong>Digital Ration Card:</strong> Transition to QR-based digital cards by mid-2025.</li>
                    <li><strong>Fair Price Shop Rule:</strong> Shops must maintain digital records of distribution.</li>
                </ul>
            </section>

            
            <section class="additional-content">
               
                <div class="recent-activities">
                    <h3>Recent Activities</h3>
                    <ul>
                        <li>5 new cardholders registered today.</li>
                        <li>20 slots allocated for tomorrow.</li>
                        <li>Updated government guidelines issued yesterday.</li>
                    </ul>
                </div>

                
                <div class="stock-info">
                    <h3>Ration Stock Information</h3>
                    <ul>
                        <li>Rice: <strong>800 kg</strong> available</li>
                        <li>Wheat: <strong>500 kg</strong> available</li>
                        <li>Sugar: <strong>200 kg</strong> available</li>
                    </ul>
                </div>

                
                <div class="success-stories">
                    <h3>Success Stories</h3>
                    <p>
                        <strong>Ramesh (Senior Citizen):</strong> "The slot-based system helped me avoid long queues, ensuring I get my rations on time."
                    </p>
                    <p>
                        <strong>Geeta (Working Mother):</strong> "I can now pick up rations after work without worrying about delays."
                    </p>
                </div>

                
                <div class="ration-schemes">
                    <h3>Ration Scheme Highlights</h3>
                    <ul>
                        <li>PM Garib Kalyan Yojana: Free ration for families below the poverty line until Dec 31, 2024.</li>
                        <li>Senior Citizen Priority Slots: Dedicated slots for those above 60 years.</li>
                        <li>Disability Assistance: Doorstep delivery for people with disabilities.</li>
                    </ul>
                </div>
            </section>
        </main>
    </div>

    
    <footer>
        <p>Toll-free Helpline: 1800-123-4567</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    //generate charts dynamically

    // Fetch the dynamic data 
    const cardholders = <?php echo $total_cardholders; ?>;
    const allottedSlots = <?php echo $total_allottedSlots; ?>;
    const collectedRation = <?php echo round(($collectedRation / $total_allottedSlots) * 100, 2); ?>;
    const disabilities = <?php echo $total_disabilities; ?>;
    const seniorCitizens = <?php echo $total_seniorCitizens; ?>;
    const workingIndividuals = <?php echo $total_workingIndividuals; ?>;

    

    // Pie Chart 
    const pieChart = document.getElementById('pieChart').getContext('2d');
    const myPieChart = new Chart(pieChart, {
        type: 'pie',
        data: {
            labels: ['Cardholders', 'Working Individuals', 'Senior Citizens', 'People with Disabilities'],
            datasets: [{
                data: [cardholders, workingIndividuals, seniorCitizens, disabilities],
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0']
            }]
        }
    });
    </script>
    <script src="dashboard2.js"></script>
</body>
</html>

<script>
function logout() {
    
    alert("You have been logged out!");
    window.location.href = "login.html";
}
</script>
