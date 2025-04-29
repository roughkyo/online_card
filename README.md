# [중급]온라인 명함 (Online Card)

![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat-square&logo=php&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=flat-square&logo=tailwind-css&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=flat-square&logo=javascript&logoColor=black)

개인 정보와 프로필을 깔끔하게 표시하는 반응형 온라인 명함 웹사이트

## 주요 기능

- 🌓 다크모드/라이트모드 전환 지원
- 📱 모바일 및 데스크톱 반응형 디자인
- 👤 개인 프로필 및 연락처 정보 표시
- 🎬 추천 영상 섹션
- 📝 약력 및 프로젝트 정보 모달창
- 📬 연락하기 기능

## 기술 스택

- **프론트엔드**: Tailwind CSS, JavaScript
- **백엔드**: PHP
- **아이콘**: Font Awesome, Material Icons
- **폰트**: Google Fonts (Noto Sans KR)

## 설치 및 실행 방법

1. 저장소 클론
   ```bash
   git clone https://github.com/yourusername/online_card.git
   ```

2. 웹 서버 설정
   - Apache 또는 Nginx와 같은 웹 서버에 파일을 배포
   - PHP가 설치되어 있는지 확인

3. 웹 브라우저에서 접속
   - 로컬에서 실행 시: `http://localhost/online_card`
   - 웹 서버 배포 시: 해당 도메인으로 접속

## 커스터마이징

### 개인 정보 변경

`index.php` 파일 상단의 `$user` 배열을 수정하여 개인 정보 업데이트 가능

```php
$user = [
    'name' => '이름',
    'position' => '직책',
    'email' => '이메일',
    'phone' => '전화번호',
    'address' => '주소',
    'profile_image' => '프로필 이미지 URL'
];
```

### 약력 및 프로젝트 수정

각 모달 섹션의 HTML을 수정하여 약력, 프로젝트 등의 정보를 변경할 수 있습니다.

## 연락하기 기능 설정

연락 기능을 활성화하려면:

1. `send_mail.php` 파일을 생성하고 이메일 전송 로직 구현
2. 서버에 메일 서비스 설정

## 라이선스

YangPhago