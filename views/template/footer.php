</div>
        
        <footer class="footer mt-5 py-3 text-center text-muted">
            <div class="container">
                <p>College Course Management System &copy; <?php echo date('Y'); ?></p>
            </div>
        </footer>
    </div>

    <!-- Bootstrap JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- JavaScript for data binding and dynamic functionality -->
    <script>
        // Function to handle department change in professor form
        function handleDepartmentChange() {
            const departmentSelect = document.getElementById('department_id');
            const professorSelect = document.getElementById('professor_id');
            
            if (departmentSelect && professorSelect) {
                departmentSelect.addEventListener('change', function() {
                    // Redirect with department parameter to filter professors
                    if (professorSelect) {
                        const departmentId = this.value;
                        window.location.href = window.location.pathname + 
                            window.location.search.replace(/&department_id=[^&]*/, '') + 
                            '&department_id=' + departmentId;
                    }
                });
            }
        }

        // Function to confirm delete operations
        function confirmDelete(type, id) {
            if (confirm('Are you sure you want to delete this ' + type + '?')) {
                window.location.href = `index.php?page=${type}s&action=delete&id=${id}`;
            }
        }

        // Initialize all event handlers when document is ready
        document.addEventListener('DOMContentLoaded', function() {
            handleDepartmentChange();
        });
    </script>
</body>
</html>