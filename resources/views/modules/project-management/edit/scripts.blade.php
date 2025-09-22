{{-- JavaScript Component --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const startDate = document.getElementById('start_date');
        const endDate = document.getElementById('end_date');
        
        if (startDate && endDate) {
            startDate.addEventListener('change', function() {
                if (this.value) {
                    endDate.min = this.value;
                }
            });
            
            if (startDate.value) {
                endDate.min = startDate.value;
            }
        }

        const statusSelect = document.getElementById('status');
        if (statusSelect) {
            const statusOptions = {
                'planning': { icon: 'bi-lightbulb-fill', color: 'warning' },
                'active': { icon: 'bi-play-circle-fill', color: 'success' },
                'on_hold': { icon: 'bi-pause-circle-fill', color: 'warning' },
                'completed': { icon: 'bi-check-circle-fill', color: 'success' },
                'cancelled': { icon: 'bi-x-circle-fill', color: 'danger' }
            };

            Array.from(statusSelect.options).forEach(option => {
                if (option.value && statusOptions[option.value]) {
                    const config = statusOptions[option.value];
                    option.innerHTML = `<i class="bi ${config.icon}"></i> ${option.text.replace(/^[^A-Za-z]*/, '')}`;
                }
            });
            
            statusSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const color = selectedOption.getAttribute('data-color');
                
                this.classList.remove('border-success', 'border-warning', 'border-danger', 'border-info');
                
                if (color) {
                    this.classList.add(`border-${color}`);
                }
            });

            if (statusSelect.value) {
                statusSelect.dispatchEvent(new Event('change'));
            }
        }

        const prioritySelect = document.getElementById('priority');
        if (prioritySelect) {
            const priorityOptions = {
                'low': { stars: 2, color: 'success' },
                'medium': { stars: 3, color: 'warning' },
                'high': { stars: 4, color: 'danger' },
                'critical': { stars: 5, color: 'danger' }
            };
            
            Array.from(prioritySelect.options).forEach(option => {
                if (option.value && priorityOptions[option.value]) {
                    const config = priorityOptions[option.value];
                    const stars = '<i class="bi bi-star-fill"></i>'.repeat(config.stars);
                    option.innerHTML = `${stars} ${option.text}`;
                }
            });
            
            prioritySelect.addEventListener('change', function() {
                this.classList.remove('border-success', 'border-warning', 'border-danger');
                
                switch(this.value) {
                    case 'low':
                        this.classList.add('border-success');
                        break;
                    case 'medium':
                        this.classList.add('border-warning');
                        break;
                    case 'high':
                    case 'critical':
                        this.classList.add('border-danger');
                        break;
                }
            });
            
            if (prioritySelect.value) {
                prioritySelect.dispatchEvent(new Event('change'));
            }
        }

        const managerSelect = document.getElementById('manager_id');
        if (managerSelect) {
            Array.from(managerSelect.options).forEach(option => {
                if (option.value === '') {
                    option.innerHTML = '<i class="bi bi-person"></i> Select Manager';
                } else {
                    option.innerHTML = `<i class="bi bi-person-badge"></i> ${option.text}`;
                }
            });
        }
    });
</script>
