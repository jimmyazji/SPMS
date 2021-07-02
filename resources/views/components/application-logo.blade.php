<svg xmlns="http://www.w3.org/2000/svg" viewBox="147 0 206 151" {{ $attributes }}>
     <defs>
          <filter id="editing-hole" width="300%" height="300%" x="-100%" y="-100%">
               <feFlood flood-color="#000" result="black" />
               <feMorphology in="SourceGraphic" operator="dilate" radius="2" result="erode" />
               <feGaussianBlur in="erode" result="blur" stdDeviation="4" />
               <feOffset dx="2" dy="2" in="blur" result="offset" />
               <feComposite in="offset" in2="black" operator="atop" result="merge" />
               <feComposite in="merge" in2="SourceGraphic" operator="in" result="inner-shadow" />
          </filter>
     </defs>
     <g filter="url(#editing-hole)">
          <path
               d="M197 104q-8 0-11-4t-3-12v-6h11v7q0 4 2 4h2l1-3-1-5-1-3-4-3-5-5q-5-6-5-12 0-7 3-11 3-3 9-3 8 0 11 3 3 4 3 13h-11v-4-2h-4l-1 2q0 3 3 6l7 6 3 4 3 5 1 6q0 8-3 12-3 5-10 5zm16-1V48h15q7 0 9 4 3 5 3 13t-2 12q-3 4-9 4h-5v22h-11zm11-32h4l1-3v-3l-1-5q0-2-3-2h-1v13zm30 32h-10V48h16l5 34 5-34h16v55h-10V63l-6 40h-10l-6-40v40zm50 1q-7 0-10-4-4-4-4-12v-6h11v7q0 4 3 4h2v-3-5l-2-3-4-3-4-5q-6-6-6-12 0-7 3-11 4-3 10-3 7 0 11 3 3 4 3 13h-11v-4l-1-2h-4v2q0 3 3 6l6 6 4 4 2 5 1 6q0 8-3 12-3 5-10 5z" />
     </g>
</svg>