<?php
//000000000010
 exit();?>
think_serialize:a:12:{s:2:"id";i:2;s:9:"user_name";s:6:"老白";s:5:"title";s:27:"Spring Boot 学习系列一";s:4:"cont";s:2027:"[strong]前言[/strong][br]
Spring Boot是Spring 官方的顶级项目之一，她的其他小伙伴还有Spring Cloud、Spring Framework、Spring Data等等
[br]
1.配置你项目的pom.xml
[pre][pom.xml]
<parent>
  <groupId>org.springframework.boot</groupId>
  <artifactId>spring-boot-starter-parent</artifactId>
  <version>1.4.1.RELEASE</version>
</parent>
<dependencies>
  <dependency>
      <groupId>org.springframework.boot</groupId>
      <artifactId>spring-boot-starter-web</artifactId>
  </dependency>
</dependencies>
[/pre]
2.创建Application.java
[pre][Application.java]
@RestController
@EnableAutoConfiguration
public class Application {
    @RequestMapping("/")
    String index() {
        return "Welcome to know Spring Boot !";
    }
    public static void main(String[] args) throws Exception {
        SpringApplication.run(Application.class, args);
    }
}
[/pre]
3.Just Run，执行Application.main() 或者 mvn:spring-boot:run
img[/static/file/20180903/f72252f22d5bbeaadaa008cb6a5ffd18.png] [br]

下面是Spring Boot官方关于构建Web项目的项目结构建议，你可以根据实际情况调整
[pre]
src
    com
    +- example
        +- myproject
            +- Application.java //建议位于项目的根目录，这可以简化 ComponentScan
            |
            +- domain
            |   +- Customer.java
            |   +- CustomerRepository.java
            |
            +- service
            |   +- CustomerService.java
            |
            +- web
              +- CustomerController.java
resources
    +-config//配置文件
       application.properties
    +-static//静态文件
        +-css
        +-js
        +-images
        index.html
    +-templates//模板文件
pom.xml
[/pre]
4.若想打包成可运行的jar文件则需要加入以下配置
[pre][pom.xml]
<build>
    <plugins>
        <plugin>
            <groupId>org.springframework.boot</groupId>
            <artifactId>spring-boot-maven-plugin</artifactId>
        </plugin>
    </plugins>
</build>
[/pre]";s:6:"to_top";i:0;s:3:"pic";s:58:"/static/head/20170726/e622618cf8c469ef33c5a5e31dc2f58c.png";s:7:"see_num";i:15;s:9:"argue_num";i:0;s:7:"is_best";i:0;s:11:"create_time";s:19:"2018-09-03 17:21:53";s:7:"type_id";i:2;s:4:"type";s:4:"JAVA";}