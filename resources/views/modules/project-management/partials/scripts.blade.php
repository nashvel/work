<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const tableBody = document.querySelector('tbody');
        const selectAllCheckbox = document.getElementById('selectAll');
        const bulkActionSelect = document.getElementById('bulkAction');
        let searchTimeout;

        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const searchTerm = this.value.toLowerCase();
            
            searchTimeout = setTimeout(() => {
                const rows = tableBody.querySelectorAll('tr');
                
                rows.forEach(row => {
                    if (row.querySelector('td')) {
                        const userName = row.querySelector('td:nth-child(2) p:first-child')?.textContent.toLowerCase() || '';
                        const userEmail = row.querySelector('td:nth-child(2) p:last-child')?.textContent.toLowerCase() || '';
                        const projectName = row.querySelector('td:nth-child(3)')?.textContent.toLowerCase() || '';
                        
                        const matches = userName.includes(searchTerm) || 
                                      userEmail.includes(searchTerm) || 
                                      projectName.includes(searchTerm);
                        
                        row.style.display = matches ? '' : 'none';
                    }
                });
                
                const visibleRows = Array.from(rows).filter(row => 
                    row.style.display !== 'none' && row.querySelector('td')
                );
                
                const emptyRow = tableBody.querySelector('tr:last-child');
                if (visibleRows.length === 0 && searchTerm) {
                    if (emptyRow && emptyRow.querySelector('td[colspan]')) {
                        emptyRow.querySelector('p').textContent = 'No users match your search';
                        emptyRow.style.display = '';
                    }
                } else if (visibleRows.length === 0 && !searchTerm) {
                    if (emptyRow && emptyRow.querySelector('td[colspan]')) {
                        emptyRow.querySelector('p').textContent = 'No users found';
                        emptyRow.style.display = '';
                    }
                } else {
                    if (emptyRow && emptyRow.querySelector('td[colspan]')) {
                        emptyRow.style.display = 'none';
                    }
                }
            }, 300);
        });

        selectAllCheckbox.addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.row-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('row-checkbox')) {
                const checkboxes = document.querySelectorAll('.row-checkbox');
                const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
                selectAllCheckbox.checked = checkboxes.length === checkedBoxes.length;
                selectAllCheckbox.indeterminate = checkedBoxes.length > 0 && checkedBoxes.length < checkboxes.length;
            }
        });

        bulkActionSelect.addEventListener('change', function() {
            const selectedAction = this.value;
            
            if (selectedAction === 'delete') {
                const checkboxColumns = document.querySelectorAll('.checkbox-column');
                checkboxColumns.forEach(col => {
                    col.style.display = '';
                });
                
                return;
            }
            
            if (selectedAction !== '' && selectedAction !== 'delete') {
                const checkboxColumns = document.querySelectorAll('.checkbox-column');
                checkboxColumns.forEach(col => {
                    col.style.display = 'none';
                });
                
                const deleteBtn = document.getElementById('executeDelete');
                if (deleteBtn) {
                    deleteBtn.style.display = 'none';
                }
                
                const allCheckboxes = document.querySelectorAll('.row-checkbox');
                allCheckboxes.forEach(cb => cb.checked = false);
                const selectAllCheckbox = document.getElementById('selectAll');
                if (selectAllCheckbox) {
                    selectAllCheckbox.checked = false;
                    selectAllCheckbox.indeterminate = false;
                }
            }
            
            if (selectedAction === '') {
                const checkboxColumns = document.querySelectorAll('.checkbox-column');
                checkboxColumns.forEach(col => {
                    col.style.display = 'none';
                });
                
                const deleteBtn = document.getElementById('executeDelete');
                if (deleteBtn) {
                    deleteBtn.style.display = 'none';
                }
                
                const allCheckboxes = document.querySelectorAll('.row-checkbox');
                allCheckboxes.forEach(cb => cb.checked = false);
                const selectAllCheckbox = document.getElementById('selectAll');
                if (selectAllCheckbox) {
                    selectAllCheckbox.checked = false;
                    selectAllCheckbox.indeterminate = false;
                }
                
                return;
            }
            
            const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
            
            if (selectedAction === 'export' && checkedBoxes.length > 0) {
                alert('Export functionality coming soon!');
            }   
            
            this.selectedIndex = 0;
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('row-checkbox') && e.target.checked) {
                const allCheckboxes = document.querySelectorAll('.row-checkbox');
                const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
                
                if (checkedBoxes.length === 1) {
                    showDeleteButton();
                }
            }
        });

        function showDeleteButton() {
            let deleteBtn = document.getElementById('executeDelete');
            if (!deleteBtn) {
                deleteBtn = document.createElement('button');
                deleteBtn.id = 'executeDelete';
                deleteBtn.className = 'ml-3 px-4 py-2 bg-red-600 text-white text-sm rounded-md hover:bg-red-700 whitespace-nowrap';
                deleteBtn.innerHTML = '<span class="hidden sm:inline">Delete Selected</span><span class="sm:hidden">Delete</span>';
                
                deleteBtn.addEventListener('click', function() {
                    const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
                    
                    if (checkedBoxes.length > 0) {
                        if (confirm(`Are you sure you want to delete ${checkedBoxes.length} selected project(s)?`)) {
                            const projectIds = Array.from(checkedBoxes).map(cb => cb.value);
                            
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = '{{ route("projects.bulk-delete") }}';

                            const csrfToken = document.createElement('input');
                            csrfToken.type = 'hidden';
                            csrfToken.name = '_token';
                            csrfToken.value = '{{ csrf_token() }}';
                            form.appendChild(csrfToken);

                            projectIds.forEach(id => {
                                const input = document.createElement('input');
                                input.type = 'hidden';
                                input.name = 'project_ids[]';
                                input.value = id;
                                form.appendChild(input);
                            });
                            
                            document.body.appendChild(form);
                            form.submit();
                        }
                    }
                });
                
                const actionContainer = document.querySelector('.flex.items-center.space-x-3');
                const buttonContainer = document.createElement('div');
                buttonContainer.className = 'flex-shrink-0 ml-4';
                buttonContainer.appendChild(deleteBtn);
                actionContainer.parentNode.insertBefore(buttonContainer, actionContainer.nextSibling);
            }
            
            deleteBtn.style.display = '';
        }

        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('row-checkbox')) {
                const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
                const deleteBtn = document.getElementById('executeDelete');
                
                if (checkedBoxes.length === 0 && deleteBtn) {
                    deleteBtn.style.display = 'none';
                    const checkboxColumns = document.querySelectorAll('.checkbox-column');
                    checkboxColumns.forEach(col => {
                        col.style.display = 'none';
                    });
                }
            }
        });
    });

    const toggleBtn = document.getElementById('toggleProjectPanel');
    const panelContent = document.getElementById('projectPanelContent');
    const toggleIcon = document.getElementById('panelToggleIcon');
    const closeBtn = document.getElementById('closePanelBtn');
    let isPanelOpen = sessionStorage.getItem('projectPanelOpen') === 'true';

    function togglePanel() {
        if (isPanelOpen) {
            panelContent.classList.add('translate-x-full');
            toggleIcon.style.transform = 'rotate(0deg)';
            isPanelOpen = false;
            sessionStorage.setItem('projectPanelOpen', 'false');
        } else {
            panelContent.classList.remove('translate-x-full');
            toggleIcon.style.transform = 'rotate(180deg)';
            isPanelOpen = true;
            sessionStorage.setItem('projectPanelOpen', 'true');
        }
    }

    function showPanel() {
        projectPanelContent.style.transform = 'translateX(0)';
        projectPanelContent.style.height = '100vh';
        projectPanelContent.style.top = '0px';
        projectPanelContent.style.bottom = '0px';
        panelToggleIcon.style.transform = 'rotate(180deg)';
        isPanelOpen = true;
    }

    if (isPanelOpen) {
        panelContent.classList.remove('translate-x-full');
        toggleIcon.style.transform = 'rotate(180deg)';
    }

    toggleBtn.addEventListener('click', togglePanel);
    closeBtn.addEventListener('click', togglePanel);

    document.addEventListener('click', function(e) {
        if (isPanelOpen && !panelContent.contains(e.target) && !toggleBtn.contains(e.target)) {
            togglePanel();
        }
    });

    let draggedProject = null;

    document.querySelectorAll('.project-card').forEach(card => {
        card.addEventListener('dragstart', function(e) {
            draggedProject = {
                id: this.dataset.projectId,
                name: this.dataset.projectName
            };
            this.style.opacity = '1';
            e.dataTransfer.effectAllowed = 'move';
        });

        card.addEventListener('dragend', function(e) {
            this.style.opacity = '1';
            draggedProject = null;
        });
    });

    document.querySelectorAll('.user-row').forEach(row => {
        row.addEventListener('dragover', function(e) {
            e.preventDefault();
            e.dataTransfer.dropEffect = 'move';
            this.classList.add('bg-blue-50', 'border-l-4', 'border-blue-400');
        });

        row.addEventListener('dragleave', function(e) {
            this.classList.remove('bg-blue-50', 'border-l-4', 'border-blue-400');
        });

        row.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('bg-blue-50', 'border-l-4', 'border-blue-400');
            
            if (draggedProject) {
                const userId = this.dataset.userId;
                const userName = this.dataset.userName;
                const projectData = {
                    id: draggedProject.id,
                    name: draggedProject.name
                };
                
                showConfirmationModal(`Assign "${projectData.name}" to ${userName}?`, () => {
                    if (!projectData.id) {
                        showErrorModal('Error: Project data is missing. Please try dragging again.');
                        return;
                    }
                    
                    fetch('/projects/assign', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            project_id: projectData.id,
                            user_id: userId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            sessionStorage.setItem('projectPanelOpen', 'true');
                            window.location.reload();
                        } else {
                            showErrorModal('Error assigning project: ' + (data.message || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showErrorModal('Error assigning project. Please try again.');
                    });
                });
            }
        });
    });

    function showConfirmationModal(message, onConfirm) {
        const modal = createModal('Confirm Assignment', message, [
            {
                text: 'Cancel',
                class: 'px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50',
                action: () => closeModal()
            },
            {
                text: 'Assign Project',
                class: 'ml-3 px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700',
                action: () => {
                    closeModal();
                    onConfirm();
                }
            }
        ]);
        document.body.appendChild(modal);
    }

    function showErrorModal(message) {
        const modal = createModal('Error', message, [
            {
                text: 'OK',
                class: 'px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700',
                action: () => closeModal()
            }
        ]);
        document.body.appendChild(modal);
    }

    function createModal(title, message, buttons) {
        const existingModal = document.getElementById('confirmationModal');
        if (existingModal) {
            existingModal.remove();
        }
        
        const modal = document.createElement('div');
        modal.id = 'confirmationModal';
        modal.className = 'fixed inset-0 z-[9999] overflow-y-auto';
        
        modal.innerHTML = `
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="closeModal()"></div>
                
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">${title}</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">${message}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        ${buttons.map(button => 
                            `<button type="button" class="${button.class}" onclick="document.getElementById('confirmationModal').querySelector('[data-action=\\'${button.text}\\']').click()" data-action="${button.text}">${button.text}</button>`
                        ).join('')}
                    </div>
                </div>
            </div>
        `;

        buttons.forEach((button, index) => {
            const btnElement = modal.querySelector(`[data-action="${button.text}"]`);
            btnElement.addEventListener('click', button.action);
        });

        return modal;
    }

    function closeModal() {
        const modal = document.getElementById('confirmationModal');
        if (modal) {
            modal.remove();
        }
    }
</script>
