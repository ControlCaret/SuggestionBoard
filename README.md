# 학교 건의게시판

## 학교 건의게시판에 대하여

학교에서는 많은 문제들이 발생한다. 어떠한 장비나 시설이 작동이 되지 않거나 필요할 수 있다. 이러한 문제들을 학교 게시판에 작성하거나 선생님께 문의한다. 하지만 학교 게시판은 많은 학생들이 자주 사용하지 않고 게시글마다 눌러서 내용을 확인해야하기 때문에 접근성이 낮다. 또한 선생님께 필요한 시설이나 장비를 요구할 때에는 이를 필요로 하는 학생의 수와 이로 인해 얻게 되는 이득을 알려야 한다. 이러한 점을 보완하고 개선한 웹사이트를 개발하였다.


### 목적

* 학생들의 의견을 쉽게 수렴
* 투표 기능을 이용한 간편한 동의 및 반대
* 댓글 기능을 이용한 간편한 의견 보완 및 추가

### 개선 및 보완점

* 게시글마다 눌러서 내용을 확인해야함
    * 게시글을 메인 화면에 출력
* 해당 건의를 필요로 하는 학생 수를 집계
    * 동의와 반대 버튼을 이용한 학생 수 카운트
* 해당 건의에 대해 문제 제기 혹은 보완점 추가
    * 댓글 기능을 통해 학생들의 추가적인 의견 수렴


## 작동 원리 및 구성

* HTML 5 를 이용한 인터넷 웹 사이트 구성 및 디자인 (프론트 엔드)
* CSS를 이용하여 사이트 디자인
* Javascript 를 이용하여 내부 서비스 일부 구성
* MySQL 을 이용한 데이터베이스 설계
* PHP 를 이용한 함수, DB 입출력과 같은 백엔드 개발
* Material Design for Bootstrap(이하 MDB) 를 이용한 디자인
    * Javascript
    * Pooper.js
    * jQuery

### 설계 방법

1. MySQL 데이터베이스 생성
2. 데이터베이스 테이블 생성
3. 게시글의 제목, 내용, 작성자, 학번을 데이터베이스 테이블에 입력
4. 동의, 반대 버튼을 누르면 동의 혹은 반대 숫자가 1씩 증가
5. PHP를 이용하여 데이터베이스 출력
6. MDB 를 이용하여 디자인

### 알고리즘 모델링

><img src="/img/markdown/AlgorithmModeling1.png" width="100%" height=""></img>
<img src="/img/markdown/AlgorithmModeling2.png" width="100%" height=""></img>


## 사용한 라이브러리

* MDB
    * Javascript
    * Pooper.js
    * jQuery
