<?php
//000000000010
 exit();?>
think_serialize:a:12:{s:2:"id";i:3;s:9:"user_name";s:6:"老白";s:5:"title";s:49:"Java IO的基本操作（一，控制台输入）";s:4:"cont";s:4229:"Java.io 包几乎包含了所有操作输入、输出需要的类。所有这些流类代表了输入源和输出目标。
Java.io 包中的流支持很多种格式，比如：基本类型、对象、本地化字符集等等。
一个流可以理解为一个数据的序列。输入流表示从一个源读取数据，输出流表示向一个目标写数据。
Java 为 I/O 提供了强大的而灵活的支持，使其更广泛地应用到文件传输和网络编程中。[hr]
[strong]读取控制台输入[/strong][br]
Java 的控制台输入由 System.in 完成。
为了获得一个绑定到控制台的字符流，你可以把 System.in 包装在一个 BufferedReader 对象中来创建一个字符流。
下面是创建 BufferedReader 的基本语法：
[pre]
BufferedReader br = new BufferedReader(new InputStreamReader(System.in));
[/pre]
BufferedReader 对象创建后，我们便可以使用 read() 方法从控制台读取一个字符，或者用 readLine() 方法读取一个字符串。[hr]
[strong]从控制台读取多字符输入[/strong][br]
从 BufferedReader 对象读取一个字符要使用 read() 方法，它的语法如下：
[pre]
int read() throws IOException
[/pre]
每次调用 read() 方法，它从输入流读取一个字符并把该字符作为整数值返回。 当流结束的时候返回 -1。该方法抛出 IOException。
下面的程序示范了用 read() 方法从控制台不断读取字符直到用户输入 "q"。
[pre]
package main;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;

public class App {
    public static void main(String[] args) throws IOException {
        char c;
        // 使用 System.in 创建 BufferedReader
        BufferedReader br = new BufferedReader(new InputStreamReader(System.in));
        System.out.println("输入字符, 按下 'q' 键退出。");
        // 读取字符
        do {
            c = (char) br.read();
            System.out.println(c);
        } while (c != 'q');
    }
}
[/pre]
img[/static/file/20180904/59e0b6a4611c1f9b9ac62060b57d8094.png] [hr]
[strong]从控制台读取字符串[/strong][br]
从标准输入读取一个字符串需要使用 BufferedReader 的 readLine() 方法。
它的一般格式是：
[pre]
String readLine( ) throws IOException
[/pre]
下面的程序读取和显示字符行直到你输入了单词"end"。
[pre]
package main;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;

public class App {
    public static void main(String[] args) throws IOException {
        // 使用 System.in 创建 BufferedReader
        BufferedReader br = new BufferedReader(new InputStreamReader(System.in));
        String str;
        System.out.println("Enter lines of text.");
        System.out.println("Enter 'end' to quit.");
        do {
            str = br.readLine();
            System.out.println(str);
        } while (!str.equals("end"));
    }
}
[/pre]
img[/static/file/20180904/39c362ec4b9da4819efa49a9c171fa82.png] 
(JDK 5 后的版本我们也可以使用 Java Scanner 类来获取控制台的输入)[hr]
[strong]控制台输出[/strong][br]
在此前已经介绍过，控制台的输出由 print( ) 和 println() 完成。这些方法都由类 PrintStream 定义，System.out 是该类对象的一个引用。
PrintStream 继承了 OutputStream类，并且实现了方法 write()。这样，write() 也可以用来往控制台写操作。
PrintStream 定义 write() 的最简单格式如下所示：
[pre]
void write(int byteval)
[/pre]
该方法将 byteval 的低八位字节写到流中。
下面的例子用 write() 把字符 "A" 和紧跟着的换行符输出到屏幕：
[pre]
package main;

import java.io.IOException;

public class App {
    public static void main(String[] args) throws IOException {
        int b;
        b = 'A';
        System.out.write(b);
        System.out.write('\n');
    }
}
[/pre]
img[/static/file/20180904/b3ebca6e3b8be5a90dda450ce0ecd655.png] 
（write() 方法不经常使用，因为 print() 和 println() 方法用起来更为方便。）[hr]
下图是一个描述输入流和输出流的类层次图。
img[/static/file/20180905/7343dcb815583fe150dd5443e1465942.png] [hr]";s:6:"to_top";i:0;s:3:"pic";s:58:"/static/head/20170726/e622618cf8c469ef33c5a5e31dc2f58c.png";s:7:"see_num";i:25;s:9:"argue_num";i:0;s:7:"is_best";i:0;s:11:"create_time";s:19:"2018-09-04 17:48:06";s:7:"type_id";i:2;s:4:"type";s:4:"JAVA";}