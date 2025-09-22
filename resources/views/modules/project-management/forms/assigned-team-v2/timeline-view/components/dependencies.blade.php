{{-- Dependencies Layer --}}
<div id="dependenciesLayer" class="dependencies-layer absolute inset-0 pointer-events-none z-15 hidden">
    <svg class="w-full h-full">
        {{-- Dependency Arrow: Task 1 → Task 5 --}}
        <defs>
            <marker id="arrowhead" markerWidth="10" markerHeight="7" refX="10" refY="3.5" orient="auto">
                <polygon points="0 0, 10 3.5, 0 7" fill="#f59e0b" />
            </marker>
        </defs>
        
        {{-- Task 1 (User auth) → Task 5 (Database opt) --}}
        <path d="M 25% 84 Q 27% 84 30% 108" 
              stroke="#f59e0b" 
              stroke-width="2" 
              fill="none" 
              marker-end="url(#arrowhead)"
              class="dependency-arrow"
              data-from="task-001"
              data-to="task-005">
        </path>
        
        {{-- Task 2 (Design docs) → Task 6 (Wireframes) --}}
        <path d="M 40% 156 Q 42% 156 45% 180" 
              stroke="#ec4899" 
              stroke-width="2" 
              fill="none" 
              marker-end="url(#arrowhead)"
              class="dependency-arrow"
              data-from="task-002"
              data-to="task-006">
        </path>
        
        {{-- Task 1 (User auth) → Task 3 (API testing) --}}
        <path d="M 25% 84 Q 27% 120 30% 228" 
              stroke="#8b5cf6" 
              stroke-width="2" 
              fill="none" 
              marker-end="url(#arrowhead)"
              class="dependency-arrow"
              data-from="task-001"
              data-to="task-003">
        </path>
        
        {{-- Dependency Labels --}}
        <text x="27%" y="96" class="dependency-label text-xs fill-amber-600 font-medium">Dependency</text>
        <text x="42%" y="168" class="dependency-label text-xs fill-pink-600 font-medium">Dependency</text>
        <text x="27%" y="156" class="dependency-label text-xs fill-purple-600 font-medium">Dependency</text>
    </svg>
</div>