<style>
/* Timeline View Specific Styles */
.timeline-container {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    overflow: hidden;
}

.timeline-header {
    min-height: 80px;
}

.timeline-content {
    height: calc(100vh - 400px);
    min-height: 600px;
}

.task-sidebar {
    min-width: 320px;
    max-width: 320px;
}

.chart-area {
    position: relative;
    background: linear-gradient(90deg, transparent 0%, transparent 8.33%, #f3f4f6 8.33%, #f3f4f6 8.5%, transparent 8.5%);
    background-size: 8.33% 100%;
}

.task-bar {
    min-width: 20px;
    transition: all 0.2s ease;
}

.task-bar:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.task-bar.selected {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
    z-index: 10;
}

.resize-handle-left,
.resize-handle-right {
    transition: opacity 0.2s ease;
}

.task-bar:hover .resize-handle-left,
.task-bar:hover .resize-handle-right {
    opacity: 1 !important;
}

.group-header:hover {
    transform: translateX(2px);
}

.task-row:hover {
    background-color: #f8fafc !important;
    transform: translateX(2px);
}

.dependency-arrow {
    transition: all 0.3s ease;
}

.dependency-arrow:hover {
    stroke-width: 3;
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
}

.current-date-line {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.7;
    }
}

.task-bar-tooltip {
    z-index: 50;
    white-space: nowrap;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

/* Responsive adjustments */
@media (max-width: 1024px) {
    .task-sidebar {
        min-width: 280px;
        max-width: 280px;
    }
    
    .timeline-header {
        min-height: 100px;
    }
}

@media (max-width: 768px) {
    .timeline-content {
        flex-direction: column;
    }
    
    .task-sidebar {
        min-width: 100%;
        max-width: 100%;
        height: 200px;
    }
    
    .chart-area {
        height: 400px;
    }
}

/* Custom scrollbar for timeline areas */
.timeline-container ::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

.timeline-container ::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 4px;
}

.timeline-container ::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 4px;
}

.timeline-container ::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

/* Timeline grid styling */
.grid-lines {
    opacity: 0.6;
}

/* Task bar status animations */
.task-bar[data-status="stuck"] .task-bar-main {
    animation: shake 0.5s ease-in-out infinite alternate;
}

@keyframes shake {
    0% { transform: translateX(0px); }
    100% { transform: translateX(1px); }
}

.task-bar[data-status="done"] .task-bar-main {
    background: linear-gradient(45deg, #10b981, #047857) !important;
}

.task-bar[data-status="overdue"] .task-bar-main {
    background: linear-gradient(45deg, #ef4444, #dc2626) !important;
    animation: pulse 1s ease-in-out infinite alternate;
}

/* Group collapse animations */
.group-tasks {
    transition: all 0.3s ease;
    overflow: hidden;
}

.group-toggle {
    transition: transform 0.2s ease;
}

/* Improved hover states */
.timeline-header button:hover,
.workload-panel button:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

/* Loading states */
.timeline-loading {
    position: relative;
    overflow: hidden;
}

.timeline-loading::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
    animation: loading 1.5s infinite;
}

@keyframes loading {
    0% { left: -100%; }
    100% { left: 100%; }
}
</style>