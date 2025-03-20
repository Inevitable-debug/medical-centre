<?php require_once 'tools.php';?>
<body>
<nav>
    <ul>
        <li><a href = "#home">Home</a></li>
        <li><a href = "#about">About Us</a></li>
        <li><a href="booking.php">Booking</a></li>
        <li><a href = "#contact">Contact</a></li>
        <li><a href = "administration.php">Administration</a></li>
    </ul>
</nav>
    <main>
        <section id="carousel">
            <div class="carousel-container">
                <div class="carousel-slide">
                    <img src="images/1.jpg" alt="Image 1" class="carousel-image">
                </div>
                <div class="carousel-slide">
                    <img src="images/2.jpeg" alt="Image 2" class="carousel-image">
                </div>
                <div class="carousel-slide">
                    <img src="images/3.jpeg" alt="Image 3" class="carousel-image">
                </div>
                <div class="carousel-slide">
                    <img src="images/4.jpeg" alt="Image 4" class="carousel-image">
                </div>
                <div class="carousel-slide">
                    <img src="images/5.jpeg" alt="Image 5" class="carousel-image">
                </div>
            </div>
            <button id="prevBtn" class="carousel-button">&#10094;</button>
            <button id="nextBtn" class="carousel-button">&#10095;</button>
        </section>
        <section id = "about">
            <h1> About Us </h1>
            <article>
                <h2>What We Offer</h2>
                <p> Russel Street Medical opened in 2020 and is located in Melbourne’s CBD at 427 Swanston Street
                    Melbourne 3000, just opposite RMIT University Building 10 and within walking distance of Melbourne
                    central station. 
                </p>
                <p> We strive to help all our patients with a focus on preventative health care, a view to managing chronic
                    health conditions with a holistic approach, and with access to a wide range of specialist care providers
                    when needed.
                </p>
                <p> RMIT students and staff receive discounts through partnership programs.
                </p>
            </article>
            <article>
                <h2>Tabulated Fee Structure</h2>
                <table>
                        <tr>
                            <th>Consultation</th>
                            <th>Normal Fee</th>
                            <th>RMIT Member Fee</th>
                            <th>Medicare Rebate</th>
                        </tr>
                        <tr>
                            <th>Standard</th>
                            <th>$80.00</th>
                            <th>$60.00</th>
                            <th>$40.00</th>
                        </tr>
                        <tr>
                            <th>Long or Complex</th>
                            <th>$125.00</th>
                            <th>$95.00</th>
                            <th>$75.00</th>
                        </tr>
                    </table>
            </article>
        </section>
        <section id = "staff">
            <h1>The Team</h1>
            <article>
                <h2>Dr. Stephen Hill</h2>
                <figure>
                    <img src = "images/guy.webp"  width="300" alt = "A picture of Dr. Stephen Hill">
                    <figcaption>Dr. Stephen Hill, one of the primary doctors at Russel Medical Centre</figcaption>
                </figure>
                <p>Stephen Hill graduated from Auckland University in New Zealand in 2014 and obtained his Fellowship
                    from the Royal Australian College of General Practitioners in 2017.
                </p>
                <p>Over his training and practice, Stephen worked in internal medicine at the Royal Children's Hospital
                    Melbourne before transitioning to General Practice.
                </p>
            </article>

            <article>
                <h2> Ms. Kiyoku Tsu</h2>
                <figure>
                    <img src = "images/girl.webp" width="300" alt = "A picture of Ms. Kiyoku Tsu">
                    <figcaption>Ms. Kiyoku Tsu, one of the primary doctors at Russel Medical Centre</figcaption>
                </figure>
                <p>Kiyoko Tsu completed her Bachelor of Nursing at the Yong Loo Lin School of Medicine in Singapore in
                    2019.
                </p>
                <p>She is an accredited Nurse Immunizer and has worked in various hospitals within metropolitan
                    Melbourne.
                </p>
            </article>
        </section>
    </main>
<script src = "index.js"></script>
</body>