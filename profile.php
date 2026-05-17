<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
require_once 'includes/db.php';
include 'includes/header.php';

$user_id = $_SESSION['user_id'];

// Fetch user data
$stmt = $pdo->prepare("SELECT name, email, created_at FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// Fetch latest recommendation
$stmt = $pdo->prepare("SELECT suggested_course, suggested_career, generated_at FROM recommendations WHERE user_id = ? ORDER BY generated_at DESC LIMIT 1");
$stmt->execute([$user_id]);
$recommendation = $stmt->fetch();

// Fetch latest marks entry to see if they've completed it
$stmt = $pdo->prepare("SELECT id FROM marks WHERE user_id = ?");
$stmt->execute([$user_id]);
$has_completed = $stmt->fetch();

?>

<style>
.profile-container {
    max-width: 1000px;
    margin: 40px auto;
    padding: 0 20px;
}

.profile-header {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 30px;
}

.avatar {
    width: 80px;
    height: 80px;
    background: var(--gradient-primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--white);
    font-size: 2rem;
    font-weight: 700;
}

.profile-info h1 {
    margin-bottom: 5px;
}

.profile-info p {
    color: var(--text-muted);
}

.grid {
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 30px;
}

@media (max-width: 768px) {
    .grid {
        grid-template-columns: 1fr;
    }
}

.result-card {
    background: var(--gradient-bg);
    border-left: 5px solid var(--primary-color);
}

.result-card h3 {
    color: var(--primary-color);
    margin-bottom: 15px;
}

.recommendation-item {
    margin-bottom: 20px;
    padding: 15px;
    background: var(--white);
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.recommendation-item h4 {
    font-size: 1.1rem;
    color: var(--text-main);
    margin-bottom: 5px;
}

.recommendation-item p {
    color: var(--text-muted);
    font-size: 1.2rem;
    font-weight: 600;
}

.no-data {
    text-align: center;
    padding: 40px;
    background: #f8fafc;
    border-radius: 8px;
    border: 1px dashed #cbd5e1;
}

</style>

<div class="profile-container">
    <div class="profile-header">
        <div class="avatar">
            <?php echo strtoupper(substr($user['name'], 0, 1)); ?>
        </div>
        <div class="profile-info">
            <h1><?php echo htmlspecialchars($user['name']); ?></h1>
            <p><?php echo htmlspecialchars($user['email']); ?></p>
            <p style="font-size: 0.85rem; margin-top: 5px;">Member since <?php echo date('M j, Y', strtotime($user['created_at'])); ?></p>
        </div>
    </div>

    <div class="grid">
        <div class="card">
            <h3 style="margin-bottom: 20px; border-bottom: 1px solid #e2e8f0; padding-bottom: 10px;">Status</h3>
            <?php if ($has_completed): ?>
                <div style="display: flex; align-items: center; gap: 10px; color: #16a34a;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    <strong>Assessment Completed</strong>
                </div>
                <div class="mt-4">
                    <a href="assessment.php" class="btn btn-outline" style="width: 100%; text-align: center;">Retake Assessment</a>
                </div>
            <?php else: ?>
                <div style="display: flex; align-items: center; gap: 10px; color: #f59e0b;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    <strong>Assessment Pending</strong>
                </div>
                <div class="mt-4">
                    <a href="assessment.php" class="btn btn-primary" style="width: 100%; text-align: center;">Start Assessment</a>
                </div>
            <?php endif; ?>
        </div>

        <div>
            <?php if ($recommendation): ?>
                <div class="card result-card">
                    <h3>Your Career Recommendations</h3>
                    <p style="margin-bottom: 20px; color: var(--text-muted);">Based on our analysis of your academic record and aptitude test, we suggest the following path:</p>
                    
                    <div class="recommendation-item">
                        <h4>Suggested Course / Degree</h4>
                        <p><?php echo htmlspecialchars($recommendation['suggested_course']); ?></p>
                    </div>

                    <div class="recommendation-item">
                        <h4>Suggested Career Path</h4>
                        <p><?php echo htmlspecialchars($recommendation['suggested_career']); ?></p>
                    </div>

                    <div style="text-align: right; font-size: 0.85rem; color: #94a3b8; margin-top: 20px;">
                        Generated on <?php echo date('M j, Y, g:i a', strtotime($recommendation['generated_at'])); ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="no-data">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#cbd5e1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 15px;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                    <h3>No Recommendations Yet</h3>
                    <p>Complete your career assessment to get personalized suggestions.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
