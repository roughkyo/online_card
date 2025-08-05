<?php
// 사용자 정보 변수 설정 (나중에 데이터베이스 연동 시 활용 가능)
$user = [
    'name' => 'Yang Phago',
    'position' => 'AI connector, AI teacher',
    'email' => 'roughkyo@gmail.com',
    'phone' => '010-OOOO-OOOO',
    'address' => 'OO시 OO구',
    'profile_image' => 'https://i.postimg.cc/ZKBJHn5W/Yang-Phago.png'  // 이미지 URL 변경
];

// 디바이스 타입 감지 (모바일/데스크톱)
function isMobile()
{
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

$device_type = isMobile() ? 'mobile' : 'desktop';
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $user['name'] ?>의 온라인 명함</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            light: '#f97316',
                            DEFAULT: '#f97316',
                            dark: '#ea580c',
                        }
                    }
                }
            }
        }
    </script>
    <!-- 커스텀 스타일시트 -->
    <link rel="stylesheet" href="style.css">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Noto Sans KR', sans-serif;
            background-color: #1a1a1a;
            color: #ffffff;
        }

        /* 모달 애니메이션 */
.fixed > div:first-child {
    transition: transform 0.2s ease-out, opacity 0.2s ease-out;
    transform: scale(0.95);
    opacity: 0;
}

.fixed > div:first-child.scale-100 {
    transform: scale(1);
    opacity: 1;
}

/* 타임라인 스타일 */
.timeline-dot {
    position: absolute;
    left: -9px;
    top: 50%;
    transform: translateY(-50%);
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background-color: #f97316;
}

/* 다이얼로그 입력 필드 포커스 효과 */
input:focus, textarea:focus {
    box-shadow: 0 0 0 2px rgba(249, 115, 22, 0.25);
}

/* 스크롤바 스타일링 */
.overflow-y-auto::-webkit-scrollbar {
    width: 6px;
}

.overflow-y-auto::-webkit-scrollbar-track {
    background: #374151;
}

.overflow-y-auto::-webkit-scrollbar-thumb {
    background: #f97316;
    border-radius: 3px;
}

.overflow-y-auto::-webkit-scrollbar-thumb:hover {
    background: #ea580c;
}
    </style>
    <!-- Font Awesome 추가 (head 섹션 내부에 추가) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-900 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-gray-800 rounded-lg overflow-hidden shadow-lg card-container">
        <!-- 상단 검색바 영역 -->
        <div class="p-4 flex items-center bg-gray-800 border-b border-gray-700">
            <div class="flex-1 flex items-center rounded-full bg-gray-700 px-4 py-2 text-gray-300 border-2 border-orange-500">
                <span class="material-icons mr-2">search</span>
                <input type="text" placeholder="검색" class="bg-transparent focus:outline-none w-full text-white" disabled>
            </div>
            <div class="ml-4 bg-orange-500 h-8 w-8 rounded-full flex items-center justify-center icon-container">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M14.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L16.586 11H5a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>

        <!-- 네비게이션 메뉴 -->
<div class="p-4 flex justify-end border-b border-gray-700 bg-gray-800">
    <nav class="flex space-x-5">
        <a href="#about" class="flex items-center text-gray-300 hover:text-orange-500 transition-colors">
            <i class="fas fa-user mr-2"></i>
            <span class="hidden sm:inline">About Me</span>
        </a>
        <a href="#history" class="flex items-center text-gray-300 hover:text-orange-500 transition-colors">
            <i class="fas fa-history mr-2"></i>
            <span class="hidden sm:inline">약력</span>
        </a>
        <a href="#projects" class="flex items-center text-gray-300 hover:text-orange-500 transition-colors">
            <i class="fas fa-project-diagram mr-2"></i>
            <span class="hidden sm:inline">프로젝트</span>
        </a>
        <a href="#contact" class="flex items-center text-gray-300 hover:text-orange-500 transition-colors">
            <i class="fas fa-envelope mr-2"></i>
            <span class="hidden sm:inline">연락</span>
        </a>
    </nav>
</div>

        <!-- 프로필 컨텐츠 영역 -->
        <div class="p-6 space-y-6 content-section">
            <!-- 프로필 이미지와 이름 -->
            <div class="flex flex-col items-center">
                <div class="tooltip">
                    <img src="<?= $user['profile_image'] ?>" alt="프로필 이미지"
                        class="w-28 h-28 rounded-full object-cover mb-4 border-2 border-orange-500 profile-image">
                    <span class="tooltip-text">프로필 이미지</span>
                </div>
                <h1 class="text-2xl font-bold text-white section-title"><?= $user['name'] ?></h1>
                <p class="text-gray-400"><?= $user['position'] ?></p>
                <div class="mt-2 px-3 py-1 bg-orange-500 bg-opacity-20 rounded-full text-xs text-orange-400">
                    <span><?= $device_type ?> 기기에서 보는 중</span>
                </div>
            </div>

            <!-- 연락처 정보 -->
            <div class="space-y-3 border-t border-gray-700 pt-4">
                <div class="flex items-center">
                    <div class="bg-orange-500 rounded-full p-2 mr-3 icon-container">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">이메일</p>
                        <p class="text-white"><?= $user['email'] ?></p>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="bg-orange-500 rounded-full p-2 mr-3 icon-container">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">전화번호</p>
                        <p class="text-white"><?= $user['phone'] ?></p>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="bg-orange-500 rounded-full p-2 mr-3 icon-container">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">주소</p>
                        <p class="text-white"><?= $user['address'] ?></p>
                    </div>
                </div>
            </div>

            <!-- 소셜 미디어 링크 섹션 수정 -->
            <div class="flex justify-center space-x-4 pt-2 border-t border-gray-700">
                <a href="#" class="bg-orange-500 hover:bg-orange-600 rounded-full p-3 transition-transform icon-container tooltip">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-2 16h-2v-6h2v6zm-1-6.891c-.607 0-1.1-.496-1.1-1.109 0-.612.492-1.109 1.1-1.109s1.1.497 1.1 1.109c0 .613-.493 1.109-1.1 1.109zm8 6.891h-1.998v-2.861c0-1.881-2.002-1.722-2.002 0v2.861h-2v-6h2v1.093c.872-1.616 4-1.736 4 1.548v3.359z"/>
                    </svg>
                    <span class="tooltip-text">LinkedIn</span>
                </a>
                <a href="#" class="bg-orange-500 hover:bg-orange-600 rounded-full p-3 transition-transform icon-container tooltip">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                    </svg>
                    <span class="tooltip-text">GitHub</span>
                </a>
                <a href="#" class="bg-orange-500 hover:bg-orange-600 rounded-full p-3 transition-transform icon-container tooltip">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-2.917 16.083c-2.258 0-4.083-1.825-4.083-4.083s1.825-4.083 4.083-4.083c1.103 0 2.024.402 2.735 1.067l-1.107 1.068c-.304-.292-.834-.63-1.628-.63-1.394 0-2.531 1.155-2.531 2.579 0 1.424 1.138 2.579 2.531 2.579 1.616 0 2.224-1.162 2.316-1.762h-2.316v-1.4h3.855c.036.204.064.408.064.677.001 2.332-1.563 3.988-3.919 3.988zm9.917-3.5h-1.75v1.75h-1.167v-1.75h-1.75v-1.166h1.75v-1.75h1.167v1.75h1.75v1.166z"/>
                    </svg>
                    <span class="tooltip-text">Google</span>
                </a>
            </div>

            <!-- 비디오 섹션 추가 - 2x2 정사각형 그리드 -->
            <div class="mt-6 border-t border-gray-700 pt-4">
                <h2 class="text-xl font-bold text-white mb-4 flex items-center">
                    <span class="material-icons mr-2 text-orange-500">play_circle</span>
                    추천 영상
                </h2>
                
                <!-- 비디오 그리드 - 2x2 형태 -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- 첫 번째 비디오 -->
                    <div class="bg-gray-900 rounded-lg overflow-hidden shadow-md">
                        <div class="relative pb-[100%]"> <!-- 정사각형 비율 1:1 -->
                            <iframe 
                                src="https://www.youtube.com/watch?v=UZkg-bYxfH0&list=PLf1-OjJ8WJr1M2pIt27nt8kgW4_HxUwhd&ab_channel=%ED%9D%AC%EB%A0%8C%EC%B5%9C%EB%84%90Hirenze" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen
                                class="absolute top-0 left-0 w-full h-full"
                                loading="lazy"
                            ></iframe>
                        </div>
                        <div class="p-3">
                            <p class="text-sm text-white font-medium truncate">인공지능의 미래</p>
                            <p class="text-xs text-gray-400 mt-1">2023.05.15</p>
                        </div>
                    </div>
                    
                    <!-- 두 번째 비디오 -->
                    <div class="bg-gray-900 rounded-lg overflow-hidden shadow-md">
                        <div class="relative pb-[100%]"> <!-- 정사각형 비율 1:1 -->
                            <iframe 
                                src="https://www.youtube.com/watch?v=0LHWEcYKgjc&ab_channel=%EC%94%A8%EB%A7%88%EC%8A%A4%EC%97%90%EB%93%80" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen
                                class="absolute top-0 left-0 w-full h-full"
                                loading="lazy"
                            ></iframe>
                        </div>
                        <div class="p-3">
                            <p class="text-sm text-white font-medium truncate">AI 활용 사례 분석</p>
                            <p class="text-xs text-gray-400 mt-1">2023.06.22</p>
                        </div>
                    </div>
                    
                    <!-- 세 번째 비디오 -->
                    <div class="bg-gray-900 rounded-lg overflow-hidden shadow-md">
                        <div class="relative pb-[100%]"> <!-- 정사각형 비율 1:1 -->
                            <iframe 
                                src="https://www.youtube.com/watch?v=HnvitMTkXro&ab_channel=3Blue1Brown%ED%95%9C%EA%B5%AD%EC%96%B4" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen
                                class="absolute top-0 left-0 w-full h-full"
                                loading="lazy"
                            ></iframe>
                        </div>
                        <div class="p-3">
                            <p class="text-sm text-white font-medium truncate">개발자를 위한 AI 도구</p>
                            <p class="text-xs text-gray-400 mt-1">2023.08.03</p>
                        </div>
                    </div>
                    
                    <!-- 네 번째 비디오 -->
                    <div class="bg-gray-900 rounded-lg overflow-hidden shadow-md">
                        <div class="relative pb-[100%]"> <!-- 정사각형 비율 1:1 -->
                            <iframe 
                                src="https://www.youtube.com/watch?v=jPs3n9Vou9c&t=16s&ab_channel=%EB%A9%94%ED%83%80%EC%BD%94%EB%93%9CM" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen
                                class="absolute top-0 left-0 w-full h-full"
                                loading="lazy"
                            ></iframe>
                        </div>
                        <div class="p-3">
                            <p class="text-sm text-white font-medium truncate">머신러닝 기초 강좌</p>
                            <p class="text-xs text-gray-400 mt-1">2023.09.10</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 다크모드/라이트모드 전환 버튼 -->
<button id="theme-toggle" class="fixed bottom-6 right-6 z-10 bg-orange-500 hover:bg-orange-600 text-white p-3 rounded-full shadow-lg transform transition-transform hover:scale-110">
    <span id="dark-icon" class="material-icons">light_mode</span>
    <span id="light-icon" class="material-icons hidden">dark_mode</span>
</button>

<!-- 테마 전환 스크립트 -->
<script>
    // 테마 상태 저장을 위한 로컬 스토리지 키
    const THEME_KEY = 'online-card-theme';
    
    // DOM 요소
    const themeToggle = document.getElementById('theme-toggle');
    const darkIcon = document.getElementById('dark-icon');
    const lightIcon = document.getElementById('light-icon');
    const html = document.documentElement;
    
    // 초기 테마 설정
    function initTheme() {
        // 저장된 테마 가져오기
        const savedTheme = localStorage.getItem(THEME_KEY);
        
        // 저장된 테마가 있거나 시스템이 다크모드인 경우
        if (savedTheme === 'dark' || 
            (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            applyDarkTheme();
        } else {
            applyLightTheme();
        }
    }
    
    // 다크 테마 적용
    function applyDarkTheme() {
        html.classList.add('dark');
        darkIcon.classList.remove('hidden');
        lightIcon.classList.add('hidden');
        localStorage.setItem(THEME_KEY, 'dark');
        
        // 다크모드 색상 적용 - flex 속성 유지
        document.body.className = 'bg-gray-900 text-white min-h-screen flex items-center justify-center p-4';
        document.querySelector('.card-container').classList.remove('bg-white');
        document.querySelector('.card-container').classList.add('bg-gray-800');
    }
    
    // 라이트 테마 적용
    function applyLightTheme() {
        html.classList.remove('dark');
        lightIcon.classList.remove('hidden');
        darkIcon.classList.add('hidden');
        localStorage.setItem(THEME_KEY, 'light');
        
        // 라이트모드 색상 적용 - flex 속성 유지
        document.body.className = 'bg-gray-100 text-gray-800 min-h-screen flex items-center justify-center p-4';
        document.querySelector('.card-container').classList.remove('bg-gray-800');
        document.querySelector('.card-container').classList.add('bg-white');
    }
    
    // 테마 전환
    function toggleTheme() {
        if (html.classList.contains('dark')) {
            applyLightTheme();
        } else {
            applyDarkTheme();
        }
    }
    
    // 이벤트 리스너
    themeToggle.addEventListener('click', toggleTheme);
    
    // 초기화
    document.addEventListener('DOMContentLoaded', initTheme);
</script>

<!-- About Me 모달창 -->
<div id="aboutModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div class="bg-gray-800 rounded-lg p-6 max-w-md w-full mx-4 shadow-xl transform transition-all">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-white flex items-center">
                <i class="fas fa-user mr-2 text-orange-500"></i>
                About Me
            </h3>
            <button onclick="closeModal('aboutModal')" class="text-gray-400 hover:text-white">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="text-gray-300">
            <p class="mb-4">컴퓨터교육과출신의 찐 AI 연구자</p>
            <p class="mb-3">인공지능과 교육의 융합에 관심이 많으며, 최신 AI 기술을 교육 현장에 적용하는 방법을 연구하고 있습니다.</p>
            <p>다양한 AI 프로젝트와 교육 콘텐츠 제작을 통해 학생들이 쉽게 AI를 접할 수 있는 환경을 만들고 있습니다.</p>
        </div>
        <div class="mt-6 flex justify-end">
            <button onclick="closeModal('aboutModal')" class="bg-orange-500 hover:bg-orange-600 text-white py-2 px-4 rounded-full">
                닫기
            </button>
        </div>
    </div>
</div>

<!-- 약력 타임라인 모달 -->
<div id="historyModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div class="bg-gray-800 rounded-lg p-6 max-w-md w-full mx-4 shadow-xl transform transition-all max-h-[80vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-white flex items-center">
                <i class="fas fa-history mr-2 text-orange-500"></i>
                약력
            </h3>
            <button onclick="closeModal('historyModal')" class="text-gray-400 hover:text-white">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="relative">
            <!-- 타임라인 중앙선 -->
            <div class="absolute left-4 top-0 h-full w-0.5 bg-orange-500"></div>
            
            <!-- 타임라인 항목 -->
            <div class="ml-12 relative mb-8">
                <div class="timeline-dot"></div>
                <div class="bg-gray-700 rounded-lg p-4">
                    <h4 class="text-white font-bold">AIDEAP 마스터 교원</h4>
                    <p class="text-gray-400 text-sm">2023년 - 현재</p>
                    <p class="text-gray-300 mt-2">AI 교육 혁신을 위한 마스터 교원으로 활동</p>
                </div>
            </div>
            
            <div class="ml-12 relative mb-8">
                <div class="timeline-dot"></div>
                <div class="bg-gray-700 rounded-lg p-4">
                    <h4 class="text-white font-bold">정보교육 유공교원</h4>
                    <p class="text-gray-400 text-sm">2022년</p>
                    <p class="text-gray-300 mt-2">정보교육 분야에서의 공로를 인정받음</p>
                </div>
            </div>
            
            <div class="ml-12 relative mb-8">
                <div class="timeline-dot"></div>
                <div class="bg-gray-700 rounded-lg p-4">
                    <h4 class="text-white font-bold">정보교육지원단</h4>
                    <p class="text-gray-400 text-sm">2021년</p>
                    <p class="text-gray-300 mt-2">정보교육 확산 및 질적 향상을 위한 지원 활동 수행</p>
                </div>
            </div>
        </div>
        <div class="mt-6 flex justify-end">
            <button onclick="closeModal('historyModal')" class="bg-orange-500 hover:bg-orange-600 text-white py-2 px-4 rounded-full">
                닫기
            </button>
        </div>
    </div>
</div>

<!-- 프로젝트 모달 -->
<div id="projectsModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div class="bg-gray-800 rounded-lg p-6 max-w-md w-full mx-4 shadow-xl transform transition-all max-h-[80vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-white flex items-center">
                <i class="fas fa-project-diagram mr-2 text-orange-500"></i>
                프로젝트
            </h3>
            <button onclick="closeModal('projectsModal')" class="text-gray-400 hover:text-white">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="space-y-4">
            <div class="bg-gray-700 rounded-lg p-4">
                <h4 class="text-white font-bold">바이든vs날리면</h4>
                <p class="text-gray-400 text-sm">2023년</p>
                <p class="text-gray-300 mt-2">AI 기반 정치 담화 분석 및 시각화 프로젝트</p>
                <div class="mt-3 flex justify-end">
                    <a href="#" class="text-orange-500 hover:text-orange-400 text-sm flex items-center">
                        <span>자세히 보기</span>
                        <i class="fas fa-chevron-right ml-1 text-xs"></i>
                    </a>
                </div>
            </div>
            
            <div class="bg-gray-700 rounded-lg p-4">
                <h4 class="text-white font-bold">AI 교육 플랫폼</h4>
                <p class="text-gray-400 text-sm">2022년</p>
                <p class="text-gray-300 mt-2">학생들을 위한 맞춤형 AI 학습 시스템 개발</p>
                <div class="mt-3 flex justify-end">
                    <a href="#" class="text-orange-500 hover:text-orange-400 text-sm flex items-center">
                        <span>자세히 보기</span>
                        <i class="fas fa-chevron-right ml-1 text-xs"></i>
                    </a>
                </div>
            </div>
            
            <div class="bg-gray-700 rounded-lg p-4">
                <h4 class="text-white font-bold">정보교육 콘텐츠 제작</h4>
                <p class="text-gray-400 text-sm">2021년</p>
                <p class="text-gray-300 mt-2">컴퓨팅 사고력 향상을 위한 교육자료 개발</p>
                <div class="mt-3 flex justify-end">
                    <a href="#" class="text-orange-500 hover:text-orange-400 text-sm flex items-center">
                        <span>자세히 보기</span>
                        <i class="fas fa-chevron-right ml-1 text-xs"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="mt-6 flex justify-end">
            <button onclick="closeModal('projectsModal')" class="bg-orange-500 hover:bg-orange-600 text-white py-2 px-4 rounded-full">
                닫기
            </button>
        </div>
    </div>
</div>

<!-- 연락 다이얼로그 -->
<div id="contactDialog" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div class="bg-gray-800 rounded-lg p-6 max-w-md w-full mx-4 shadow-xl transform transition-all">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-white flex items-center">
                <i class="fas fa-envelope mr-2 text-orange-500"></i>
                연락하기
            </h3>
            <button onclick="closeModal('contactDialog')" class="text-gray-400 hover:text-white">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="contactForm" class="space-y-4" method="post" action="javascript:void(0);" onsubmit="submitContact(); return false;">
            <div>
                <label for="name" class="block text-gray-300 mb-1">이름 <span class="text-orange-500">*</span></label>
                <input type="text" id="name" name="name" required class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-orange-500">
            </div>
            <div>
                <label for="email" class="block text-gray-300 mb-1">이메일 또는 연락처 <span class="text-orange-500">*</span></label>
                <input type="email" id="email" name="email" required class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-orange-500">
            </div>
            <div>
                <label for="message" class="block text-gray-300 mb-1">메시지 <span class="text-orange-500">*</span></label>
                <textarea id="message" name="message" rows="4" required class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-orange-500"></textarea>
            </div>
            <div class="flex justify-end space-x-3">
    <button type="button" onclick="closeModal('contactDialog')" class="bg-gray-600 hover:bg-gray-500 text-white py-2 px-4 rounded-full">
        취소
    </button>
    <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white py-2 px-4 rounded-full">
        보내기
    </button>
</div>
        </form>
    </div>
</div>

<!-- 모달 및 다이얼로그 제어 스크립트 -->
<script>
    // 모달 열기 함수
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
        // 모달 열릴 때 애니메이션 추가
        setTimeout(() => {
            document.getElementById(modalId).querySelector('div:first-child').classList.add('scale-100');
            document.getElementById(modalId).querySelector('div:first-child').classList.remove('scale-95');
        }, 10);
    }
    
    // 모달 닫기 함수
    function closeModal(modalId) {
        // 모달 닫힐 때 애니메이션 추가
        document.getElementById(modalId).querySelector('div:first-child').classList.add('scale-95');
        document.getElementById(modalId).querySelector('div:first-child').classList.remove('scale-100');
        
        setTimeout(() => {
            document.getElementById(modalId).classList.add('hidden');
        }, 200);
    }
    
    // 연락 폼 제출 처리
    function submitContact() {
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const message = document.getElementById('message').value;
        
        // 유효성 검사
        if (!name || !email) {
            alert('이름과 연락처를 입력해주세요.');
            return;
        }
        
        // 로딩 상태 표시
        const submitBtn = document.querySelector('#contactForm button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> 전송 중...';
        
        // FormData 객체 생성
        const formData = new FormData();
        formData.append('name', name);
        formData.append('email', email);
        formData.append('message', message);
        
        // 서버에 전송
        fetch('send_mail.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('메시지가 성공적으로 전송되었습니다. 감사합니다!');
                closeModal('contactDialog');
                document.getElementById('contactForm').reset();
            } else {
                alert('오류: ' + data.message);
            }
        })
        .catch(error => {
            alert('메일 전송 중 오류가 발생했습니다: ' + error.message);
        })
        .finally(() => {
            // 버튼 상태 복원
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        });
    }
    
    // 페이지 로드 시 이벤트 리스너 등록
    document.addEventListener('DOMContentLoaded', function() {
        // 모달 열기 이벤트 등록
        document.querySelector('a[href="#about"]').addEventListener('click', function(e) {
            e.preventDefault();
            openModal('aboutModal');
        });
        
        document.querySelector('a[href="#history"]').addEventListener('click', function(e) {
            e.preventDefault();
            openModal('historyModal');
        });
        
        document.querySelector('a[href="#projects"]').addEventListener('click', function(e) {
            e.preventDefault();
            openModal('projectsModal');
        });
        
        document.querySelector('a[href="#contact"]').addEventListener('click', function(e) {
            e.preventDefault();
            openModal('contactDialog');
        });
        
        // ESC 키로 모달 닫기
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const openModals = document.querySelectorAll('.fixed.inset-0:not(.hidden)');
                openModals.forEach(modal => {
                    const modalId = modal.id;
                    if (modalId) {
                        closeModal(modalId);
                    }
                });
            }
        });
        
        // 모달 바깥 클릭 시 닫기
        document.querySelectorAll('#aboutModal, #historyModal, #projectsModal, #contactDialog').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal(modal.id);
                }
            });
        });
    });
</script>
</body>

</html>