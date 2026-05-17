<?php include 'includes/header.php'; ?>

<style>
.contact-container {
    max-width: 800px;
    margin: 60px auto;
    padding: 0 20px;
}

.contact-header {
    text-align: center;
    margin-bottom: 40px;
}

.contact-header h1 {
    font-size: 2.5rem;
    color: var(--text-main);
    margin-bottom: 10px;
}

.contact-header p {
    color: var(--text-muted);
    font-size: 1.1rem;
}

.contact-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
}

@media (max-width: 768px) {
    .contact-grid {
        grid-template-columns: 1fr;
    }
}

.contact-info {
    padding: 30px;
    background: var(--gradient-primary);
    color: var(--white);
    border-radius: 16px;
    box-shadow: var(--card-shadow);
}

.contact-info h3 {
    margin-bottom: 20px;
    color: var(--white);
}

.info-item {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
}

.info-item svg {
    background: rgba(255,255,255,0.2);
    padding: 10px;
    border-radius: 50%;
    width: 44px;
    height: 44px;
}

</style>

<div class="contact-container">
    <div class="contact-header">
        <h1>Get In Touch</h1>
        <p>Have questions about your career path? We're here to help.</p>
    </div>

    <div class="contact-grid">
        <div class="contact-info">
            <h3>Contact Information</h3>
            <p style="margin-bottom: 30px; opacity: 0.9;">Fill up the form and our Team will get back to you within 24 hours.</p>
            
            <div class="info-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                <span>+1 (555) 123-4567</span>
            </div>
            <div class="info-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                <span>support@careerguide.com</span>
            </div>
            <div class="info-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                <span>123 Education Lane, Tech City</span>
            </div>
        </div>

        <div class="card">
            <?php
            if (isset($_GET['success'])) {
                echo '<div style="background: #dcfce7; color: #166534; padding: 15px; border-radius: 8px; margin-bottom: 20px;">Your message has been sent successfully!</div>';
            }
            if (isset($_GET['error'])) {
                echo '<div style="background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 8px; margin-bottom: 20px;">There was an error sending your message.</div>';
            }
            ?>
            <form action="endpoints/submit_contact.php" method="POST">
                <div class="form-group">
                    <label class="form-label" for="name">Your Name</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="email">Your Email</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="message">Message</label>
                    <textarea id="message" name="message" class="form-control" rows="5" required style="resize: vertical;"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Send Message</button>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
