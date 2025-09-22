 <style>
     .slide-up {
         animation: slideUp 0.3s ease-out forwards;
     }

     .slide-down {
         animation: slideDown 0.3s ease-out forwards;
     }

     @keyframes slideUp {
         from {
             transform: translateY(100%);
             opacity: 0;
         }

         to {
             transform: translateY(0);
             opacity: 1;
         }
     }

     @keyframes slideDown {
         from {
             transform: translateY(0);
             opacity: 1;
         }

         to {
             transform: translateY(100%);
             opacity: 0;
         }
     }

     #chat-list {
         max-height: 350px;
         overflow-y: auto;
         scroll-behavior: smooth;
     }

     #chat-panel {
         width: 30rem;
         box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
         border-radius: 1rem;
         overflow: hidden;
     }

     .message-bubble {
         padding: 0.75rem 1rem;
         border-radius: 1.25rem;
         max-width: 75%;
         font-size: 0.875rem;
         box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
     }

     button:disabled {
         opacity: 0.4;
         cursor: not-allowed;
     }

     #chat-toggle {
         position: fixed;
         bottom: 1rem;
         right: 1rem;
         z-index: 9999;
     }

     #chat-toggle button {
         background-color: #2563eb;
         color: white;
         font-size: 1rem;
         padding: 0.75rem 1.5rem;
         border-radius: 9999px;
         display: flex;
         align-items: center;
         gap: 0.5rem;
         box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
         border: none;
         cursor: pointer;
     }

     #chat-toggle button img {
         width: 1.5rem;
         height: 1.5rem;
         border-radius: 9999px;
     }

     #notification-badge {
         position: absolute;
         top: -0.5rem;
         left: -0.5rem;
         width: 0.75rem;
         height: 0.75rem;
         background-color: #ef4444;
         border-radius: 9999px;
         display: none;
     }

     #chat-list ul {
         list-style-type: disc;
         padding-left: 1.5rem;
     }

     #chat-list ul ul {
         list-style-type: circle;
         padding-left: 1.5rem;
     }

     #chat-list li {
         margin-bottom: 0.3rem;
         line-height: 1.6;
         font-size: 14px;
         color: #333;
     }

     #chat-list li strong {
         display: block;
         font-weight: 600;
         font-size: 15px;
         color: #222;
     }
 </style>
