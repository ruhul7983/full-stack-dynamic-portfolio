<link rel="stylesheet" href="{{ asset('assets/css/contact.css') }}">
<section id="contact" class="contact-section">
    <div class="container">
        
        <div class="contact-wrapper">
            <div class="contact-info">
                <span class="sub-headline">Get in Touch</span>
                <h2>Let's build something <span class="highlight">amazing</span> together.</h2>
                <p>Have a project in mind or just want to say hi? Feel free to send me a message.</p>

                <div class="info-items">
                    <div class="info-box">
                        <div class="icon-circle">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="24" height="24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h4>Email Me</h4>
                            <a href="mailto:amin22205101245@diu.edu.bd">amin22205101245@diu.edu.bd</a>
                        </div>
                    </div>

                    <div class="info-box">
                        <div class="icon-circle">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="24" height="24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <h4>Location</h4>
                            <p>Dhaka, Bangladesh</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="contact-form-card">
                <form action="#" method="POST">
                    @csrf <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text" id="name" name="name" placeholder="John Doe" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Your Email</label>
                        <input type="email" id="email" name="email" placeholder="john@example.com" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="5" placeholder="Tell me about your project..." required></textarea>
                    </div>

                    <button type="submit" class="btn-submit">Send Message</button>
                </form>
            </div>
        </div>

    </div>
</section>