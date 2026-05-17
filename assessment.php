<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
include 'includes/header.php';
?>

<style>
.assessment-container {
    max-width: 800px;
    margin: 40px auto;
    padding: 0 20px;
}

.progress-bar-container {
    background: #e2e8f0;
    border-radius: 8px;
    height: 10px;
    margin-bottom: 30px;
    overflow: hidden;
}

.progress-bar {
    background: var(--gradient-primary);
    height: 100%;
    width: 25%; /* initial step */
    transition: width 0.4s ease;
}

.step {
    display: none;
    animation: fadeIn 0.5s;
}

.step.active {
    display: block;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.step-header {
    margin-bottom: 25px;
}

.step-header h2 {
    color: var(--primary-color);
}

.btn-group {
    display: flex;
    justify-content: space-between;
    margin-top: 30px;
}

.hidden {
    display: none !important;
}

.question-card {
    background: #f8fafc;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 15px;
}

.question-card h4 {
    margin-bottom: 15px;
}

.options label {
    display: block;
    padding: 10px;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    margin-bottom: 10px;
    cursor: pointer;
    transition: var(--transition);
}

.options label:hover {
    background: #eff6ff;
    border-color: var(--primary-color);
}

.options input[type="radio"] {
    margin-right: 10px;
}
</style>

<div class="assessment-container">
    <div class="card">
        <div class="progress-bar-container">
            <div class="progress-bar" id="progress-bar"></div>
        </div>

        <form id="assessment-form">
            <!-- Step 1: Basic Info -->
            <div class="step active" id="step-1">
                <div class="step-header">
                    <h2>Step 1: Basic Information</h2>
                    <p>Tell us a bit about yourself.</p>
                </div>
                <div class="form-group">
                    <label class="form-label" for="age">Age</label>
                    <input type="number" id="age" name="age" class="form-control" required min="14" max="50">
                </div>
                <div class="form-group">
                    <label class="form-label" for="class_level">Current Educational Level</label>
                    <select id="class_level" name="class_level" class="form-control" required>
                        <option value="">Select Level</option>
                        <!--<option value="10th">10th Standard</option>-->
                        <option value="12th">12th Standard</option>
                        <option value="Graduate">Graduate</option>
                    </select>
                </div>
                <div class="btn-group">
                    <div></div> <!-- Empty div for flex spacing -->
                    <button type="button" class="btn btn-primary next-btn">Next</button>
                </div>
            </div>

            <!-- Step 2: Academic Details -->
            <div class="step" id="step-2">
                <div class="step-header">
                    <h2>Step 2: Academic Details</h2>
                    <p>Enter your academic performance details.</p>
                </div>
                <div class="form-group">
                    <label class="form-label" for="tenth_marks">10th Marks (%)</label>
                    <input type="number" id="tenth_marks" name="tenth_marks" class="form-control" required min="0" max="100" step="0.01">
                </div>
                
                <div id="twelfth-section" class="hidden">
                    <div class="form-group">
                        <label class="form-label" for="stream">12th Stream</label>
                        <select id="stream" name="stream" class="form-control">
                            <option value="">Select Stream</option>
                            <option value="Science-PCM">Science (PCM)</option>
                            <option value="Science-PCB">Science (PCB)</option>
                            <option value="Commerce">Commerce</option>
                            <option value="Arts">Arts</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="twelfth_marks">12th Overall Marks (%)</label>
                        <input type="number" id="twelfth_marks" name="twelfth_marks" class="form-control" min="0" max="100" step="0.01">
                    </div>
                    
                    <!-- Dynamic Subject Marks Containers -->
                    <div id="pcm-marks" class="hidden">
                        <div class="form-group"><label class="form-label">Physics Marks</label><input type="number" name="physics" class="form-control" min="0" max="100"></div>
                        <div class="form-group"><label class="form-label">Chemistry Marks</label><input type="number" name="chemistry" class="form-control" min="0" max="100"></div>
                        <div class="form-group"><label class="form-label">Math Marks</label><input type="number" name="math" class="form-control" min="0" max="100"></div>
                    </div>
                    
                    <div id="pcb-marks" class="hidden">
                        <div class="form-group"><label class="form-label">Physics Marks</label><input type="number" name="physics_b" class="form-control" min="0" max="100"></div>
                        <div class="form-group"><label class="form-label">Chemistry Marks</label><input type="number" name="chemistry_b" class="form-control" min="0" max="100"></div>
                        <div class="form-group"><label class="form-label">Biology Marks</label><input type="number" name="biology" class="form-control" min="0" max="100"></div>
                    </div>
                    
                    <div id="commerce-marks" class="hidden">
                        <div class="form-group"><label class="form-label">Accounts Marks</label><input type="number" name="accounts" class="form-control" min="0" max="100"></div>
                        <div class="form-group"><label class="form-label">Business Studies Marks</label><input type="number" name="business" class="form-control" min="0" max="100"></div>
                        <div class="form-group"><label class="form-label">Economics Marks</label><input type="number" name="economics" class="form-control" min="0" max="100"></div>
                    </div>
                    
                    <div id="arts-marks" class="hidden">
                        <div class="form-group"><label class="form-label">History/Geography/Pol. Science Avg Marks</label><input type="number" name="arts_subjects" class="form-control" min="0" max="100"></div>
                    </div>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-outline prev-btn">Back</button>
                    <button type="button" class="btn btn-primary next-btn">Next</button>
                </div>
            </div>

            <!-- Step 3: Aptitude -->
            <div class="step" id="step-3">
                <div class="step-header">
                    <h2>Step 3: Aptitude Test</h2>
                    <p>Answer the following to help us understand your inclinations.</p>
                </div>
                <div id="aptitude-questions-container">
                    <!-- Questions injected via JS -->
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-outline prev-btn">Back</button>
                    <button type="button" class="btn btn-primary next-btn">Next</button>
                </div>
            </div>

            <!-- Step 4: Graduate Specifics (Optional) -->
            <div class="step" id="step-4">
                <div class="step-header">
                    <h2>Step 4: Graduate Preferences</h2>
                    <p>Since you are a graduate, tell us about your goals.</p>
                </div>
                <div class="form-group">
                    <label class="form-label" for="pg_preference">Are you looking for:</label>
                    <select id="pg_preference" name="pg_preference" class="form-control">
                        <option value="Job">Direct Job / Internship</option>
                        <option value="PG">Post Graduation (Masters, MBA, etc.)</option>
                    </select>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-outline prev-btn">Back</button>
                    <button type="button" class="btn btn-primary next-btn" id="final-submit">Submit Assessment</button>
                </div>
            </div>

            <!-- Loader -->
            <div id="loader" class="hidden text-center" style="padding: 50px;">
                <h2>Analyzing your profile...</h2>
                <p>Generating the best recommendations for you.</p>
            </div>

        </form>
    </div>
</div>

<script src="assets/js/assessment.js"></script>

<?php include 'includes/footer.php'; ?>
