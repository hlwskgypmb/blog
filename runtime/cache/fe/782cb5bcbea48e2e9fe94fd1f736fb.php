<?php
//000000000010
 exit();?>
think_serialize:a:12:{s:2:"id";i:4;s:9:"user_name";s:6:"老白";s:5:"title";s:49:"Java IO的基本操作（二，输入输出流）";s:4:"cont";s:10967:"一个流被定义为一个数据序列。输入流用于从源读取数据，输出流用于向目标写数据。
[strong]FileInputStream[/strong][br]
该流用于从文件读取数据，它的对象可以用关键字 new 来创建。
有多种构造方法可用来创建对象。
可以使用字符串类型的文件名来创建一个输入流对象来读取文件：
[pre]
InputStream f = new FileInputStream("C:/java/hello");
[/pre]
也可以使用一个文件对象来创建一个输入流对象来读取文件。我们首先得使用 File() 方法来创建一个文件对象：
[pre]
File f = new File("C:/java/hello");
InputStream out = new FileInputStream(f);
[/pre]
创建了InputStream对象，就可以使用下面的方法来读取流或者进行其他的流操作。
[table][colgroup:2]
[thead]
[tr][th] 方法 [/th][th] 描述 [/th][/tr]
[/thead]
[tbody]
[tr][td] public void close() throws IOException{}[/td][td] 关闭此文件输入流并释放与此流有关的所有系统资源。抛出IOException异常。[/td][/tr]
[tr][td] protected void finalize()throws IOException {}[/td][td] 这个方法清除与该文件的连接。确保在不再引用文件输入流时调用其 close 方法。抛出IOException异常。[/td][/tr]
[tr][td] public int read(int r)throws IOException{}[/td][td] 这个方法从 InputStream 对象读取指定字节的数据。返回为整数值。返回下一字节数据，如果已经到结尾则返回-1。 [/td][/tr]
[tr][td] public int read(byte[] r) throws IOException{}[/td][td] 这个方法从输入流读取r.length长度的字节。返回读取的字节数。如果是文件结尾则返回-1。[/td][/tr]
[tr][td] public int available() throws IOException{}[/td][td] 返回下一次对此输入流调用的方法可以不受阻塞地从此输入流读取的字节数。返回一个整数值。 [/td][/tr]
[/tbody]
[/table]
除了 InputStream 外，还有一些其他的输入流
[hr][strong]ByteArrayInputStream[/strong][br]
字节数组输入流在内存中创建一个字节数组缓冲区，从输入流读取的数据保存在该字节数组缓冲区中。创建字节数组输入流对象有以下几种方式。
接收字节数组作为参数创建：
[pre]
ByteArrayInputStream bArray = new ByteArrayInputStream(byte [] a);
[/pre]
另一种创建方式是接收一个字节数组，和两个整形变量 off、len，off表示第一个读取的字节，len表示读取字节的长度。
[pre]
ByteArrayInputStream bArray = new ByteArrayInputStream(byte []a,  int off,  int len)
[/pre]
成功创建字节数组输入流对象后，可以参见以下列表中的方法，对流进行读操作或其他操作。
[table][colgroup:2]
[thead]
[tr][th] 方法 [/th][th] 描述 [/th][/tr]
[/thead]
[tbody]
[tr][td] public int read() [/td][td] 从此输入流中读取下一个数据字节。[/td][/tr]
[tr][td] public int read(byte[] r, int off, int len)[/td][td] 将最多 len 个数据字节从此输入流读入字节数组。[/td][/tr]
[tr][td] public int available() [/td][td] 返回可不发生阻塞地从此输入流读取的字节数。 [/td][/tr]
[tr][td] public void mark(int read) [/td][td] 设置流中的当前标记位置。[/td][/tr]
[tr][td] public long skip(long n)[/td][td] 从此输入流中跳过 n 个输入字节。[/td][/tr]
[/tbody]
[/table]
[strong]DataInputStream[/strong][br]
数据输入流允许应用程序以与机器无关方式从底层输入流中读取基本 Java 数据类型。
下面的构造方法用来创建数据输入流对象。
[pre]
DataInputStream dis = new DataInputStream(InputStream in);
[/pre]
另一种创建方式是接收一个字节数组，和两个整形变量 off、len，off表示第一个读取的字节，len表示读取字节的长度。
[table][colgroup:2]
[thead]
[th] 方法 [/th][th] 描述 [/th][/tr]
[/thead]
[tbody]
[tr][td] public final int read(byte[] r, int off, int len)throws IOException[/td][td] 从所包含的输入流中将 len 个字节读入一个字节数组中。如果len为-1，则返回已读字节数。 [/td][/tr]
[tr][td] Public final int read(byte [] b)throws IOException[/td][td] 从所包含的输入流中读取一定数量的字节，并将它们存储到缓冲区数组 b 中。 [/td][/tr]
[tr][td] public final Boolean readBooolean()throws IOException,
public final byte readByte()throws IOException,
public final short readShort()throws IOException
public final Int readInt()throws IOException[/td][td] 从输入流中读取字节，返回输入流中两个字节作为对应的基本数据类型返回值。[/td][/tr]
[tr][td] public String readLine() throws IOException [/td][td] 从输入流中读取下一文本行。 [/td][/tr]
[/tbody]
[/table]
[strong]FileOutputStream[/strong][br]
该类用来创建一个文件并向文件中写数据。
如果该流在打开文件进行输出前，目标文件不存在，那么该流会创建该文件。
有两个构造方法可以用来创建 FileOutputStream 对象。
使用字符串类型的文件名来创建一个输出流对象：
[pre]
OutputStream f = new FileOutputStream("C:/java/hello")
[/pre]
也可以使用一个文件对象来创建一个输出流来写文件。我们首先得使用File()方法来创建一个文件对象：
[pre]
File f = new File("C:/java/hello");
OutputStream f = new FileOutputStream(f);
[/pre]
创建OutputStream 对象完成后，就可以使用下面的方法来写入流或者进行其他的流操作。
[table][colgroup:2]
[thead]
[tr][th] 方法 [/th][th] 描述 [/th][/tr]
[/thead]
[tbody]
[tr][td] public void close() throws IOException{} [/td][td] 关闭此文件输入流并释放与此流有关的所有系统资源。抛出IOException异常。 [/td][/tr]
[tr][td] protected void finalize()throws IOException {}[/td][td] 这个方法清除与该文件的连接。确保在不再引用文件输入流时调用其 close 方法。抛出IOException异常。[/td][/tr]
[tr][td] public void write(int w)throws IOException{}[/td][td] 这个方法把指定的字节写到输出流中。[/td][/tr]
[tr][td] public void write(byte[] w) [/td][td] 把指定数组中w.length长度的字节写到OutputStream中。 [/td][/tr]
[/tbody]
[/table]
除了OutputStream外，还有一些其他的输出流[hr]
[strong]ByteArrayOutputStream[/strong][br]
字节数组输出流在内存中创建一个字节数组缓冲区，所有发送到输出流的数据保存在该字节数组缓冲区中。创建字节数组输出流对象有以下几种方式。
下面的构造方法创建一个32字节（默认大小）的缓冲区。
[pre]
OutputStream bOut = new ByteArrayOutputStream();
[/pre]
另一个构造方法创建一个大小为n字节的缓冲区。
[pre]
OutputStream bOut = new ByteArrayOutputStream(int a)
[/pre]
成功创建字节数组输出流对象后，可以参见以下列表中的方法，对流进行写操作或其他操作。
[table][colgroup:2]
[thead]
[tr][th] 方法 [/th][th] 描述 [/th][/tr]
[/thead]
[tbody]
[tr][td] public void reset()[/td][td] 将此字节数组输出流的 count 字段重置为零，从而丢弃输出流中目前已累积的所有数据输出。 [/td][/tr]
[tr][td] public byte[] toByteArray() [/td][td] 创建一个新分配的字节数组。数组的大小和当前输出流的大小，内容是当前输出流的拷贝。[/td][/tr]
[tr][td] public String toString()[/td][td] 将缓冲区的内容转换为字符串，根据平台的默认字符编码将字节转换成字符。[/td][/tr]
[tr][td] public void write(int w) [/td][td]  将指定的字节写入此字节数组输出流。[/td][/tr]
[tr][td] public void write(byte []b, int off, int len)[/td][td] 将指定字节数组中从偏移量 off 开始的 len 个字节写入此字节数组输出流。[/td][/tr]
[tr][td] public void writeTo(OutputStream outSt)[/td][td] 将此字节数组输出流的全部内容写入到指定的输出流参数中。[/td][/tr]
[/tbody]
[/table]
[strong]DataOutputStream[/strong][br]
数据输出流允许应用程序以与机器无关方式将Java基本数据类型写到底层输出流。
下面的构造方法用来创建数据输出流对象。
[pre]
DataOutputStream out = new DataOutputStream(OutputStream  out);
[/pre]
创建对象成功后，可以参照以下列表给出的方法，对流进行写操作或者其他操作。
[table][colgroup:2]
[thead]
[tr][th] 方法 [/th][th] 描述 [/th][/tr]
[/thead]
[tbody]
[tr][td] public final void write(byte[] w, int off, int len)throws IOException[/td][td] 将指定字节数组中从偏移量 off 开始的 len 个字节写入此字节数组输出流。 [/td][/tr]
[tr][td] public final int write(byte [] b)throws IOException[/td][td] 将指定的字节写入此字节数组输出流。 [/td][/tr]
[tr][td] public final void writeBooolean()throws IOException,
public final void writeByte()throws IOException,
public final void writeShort()throws IOException,
public final void writeInt()throws IOException [/td][td] 这些方法将指定的基本数据类型以字节的方式写入到输出流。 [/td][/tr]
[tr][td] public void flush()throws IOException[/td][td] 刷新此输出流并强制写出所有缓冲的输出字节。[/td][/tr]
[tr][td] public final void writeBytes(String s) throws IOException[/td][td] 将字符串以字节序列写入到底层的输出流，字符串中每个字符都按顺序写入，并丢弃其高八位。[/td][/tr]
[/tbody]
[/table]
例子--
[pre]
//文件名 :fileStreamTest2.java
import java.io.*;
 
public class fileStreamTest2 {
    public static void main(String[] args) throws IOException {
 
        File f = new File("a.txt");
        FileOutputStream fop = new FileOutputStream(f);
        // 构建FileOutputStream对象,文件不存在会自动新建
 
        OutputStreamWriter writer = new OutputStreamWriter(fop, "UTF-8");
        // 构建OutputStreamWriter对象,参数可以指定编码,默认为操作系统默认编码,windows上是gbk
 
        writer.append("中文输入");
        // 写入到缓冲区
 
        writer.append("\r\n");
        // 换行
 
        writer.append("English");
        // 刷新缓存冲,写入到文件,如果下面已经没有写入的内容了,直接close也会写入
 
        writer.close();
        // 关闭写入流,同时会把缓冲区内容写入文件,所以上面的注释掉
 
        fop.close();
        // 关闭输出流,释放系统资源
 
        FileInputStream fip = new FileInputStream(f);
        // 构建FileInputStream对象
 
        InputStreamReader reader = new InputStreamReader(fip, "UTF-8");
        // 构建InputStreamReader对象,编码与写入相同
 
        StringBuffer sb = new StringBuffer();
        while (reader.ready()) {
            sb.append((char) reader.read());
            // 转成char加到StringBuffer对象中
        }
        System.out.println(sb.toString());
        reader.close();
        // 关闭读取流
 
        fip.close();
        // 关闭输入流,释放系统资源
 
    }
}
[/pre]";s:6:"to_top";i:0;s:3:"pic";s:58:"/static/head/20170726/e622618cf8c469ef33c5a5e31dc2f58c.png";s:7:"see_num";i:15;s:9:"argue_num";i:0;s:7:"is_best";i:0;s:11:"create_time";s:19:"2018-09-05 14:35:02";s:7:"type_id";i:2;s:4:"type";s:4:"JAVA";}