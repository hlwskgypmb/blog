<?php
//000000000010
 exit();?>
think_serialize:a:12:{s:2:"id";i:6;s:9:"user_name";s:6:"老白";s:5:"title";s:39:"Java StringBuffer 和 StringBuilder 类";s:4:"cont";s:3526:"当对字符串进行修改的时候，需要使用 StringBuffer 和 StringBuilder 类。
和 String 类不同的是，StringBuffer 和 StringBuilder 类的对象能够被多次的修改，并且不产生新的未使用对象。
StringBuilder 类在 Java 5 中被提出，它和 StringBuffer 之间的最大不同在于 StringBuilder 的方法不是线程安全的（不能同步访问）。
由于 StringBuilder 相较于 StringBuffer 有速度优势，所以多数情况下建议使用 StringBuilder 类。然而在应用程序要求线程安全的情况下，则必须使用 StringBuffer 类。
[pre]
public class Test{
  public static void main(String args[]){
    StringBuffer sBuffer = new StringBuffer("aaa");
    sBuffer.append("1");
    sBuffer.append("2");
    sBuffer.append("3");
    System.out.println(sBuffer);  
  }
}
[/pre][hr]
[strong]StringBuffer 方法[/strong][br]
[table][colgroup:2]
[thead]
[tr][th] 方法 [/th][th] 描述 [/th][/tr]
[/thead]
[tbody]
[tr][td] public StringBuffer append(String s)[/td][td] 将指定的字符串追加到此字符序列。[/td][/tr]
[tr][td] public StringBuffer reverse() [/td][td] 将此字符序列用其反转形式取代。[/td][/tr]
[tr][td] public delete(int start, int end) [/td][td] 移除此序列的子字符串中的字符。 [/td][/tr]
[tr][td] public insert(int offset, int i)[/td][td] 将 int 参数的字符串表示形式插入此序列中。 [/td][/tr]
[tr][td] replace(int start, int end, String str)[/td][td] replace(int start, int end, String str)[/td][/tr]
[/tbody]
[/table]
下面的列表里的方法和 String 类的方法类似：
[table][colgroup:2]
[thead]
[tr][th] 方法 [/th][th] 描述 [/th][/tr]
[/thead]
[tbody]
[tr][td] int capacity() [/td][td] 返回当前容量。 [/td][/tr]
[tr][td] char charAt(int index) [/td][td] 返回此序列中指定索引处的 char 值。 [/td][/tr]
[tr][td] void ensureCapacity(int minimumCapacity) [/td][td] 确保容量至少等于指定的最小值。[/td][/tr]
[tr][td] void getChars(int srcBegin, int srcEnd, char[] dst, int dstBegin) [/td][td] 将字符从此序列复制到目标字符数组 dst。 [/td][/tr]
[tr][td] int indexOf(String str)[/td][td] 返回第一次出现的指定子字符串在该字符串中的索引。[/td][/tr]
[tr][td] int indexOf(String str, int fromIndex) [/td][td] 从指定的索引处开始，返回第一次出现的指定子字符串在该字符串中的索引。 [/td][/tr]
[tr][td] int lastIndexOf(String str)[/td][td] 返回最右边出现的指定子字符串在此字符串中的索引。[/td][/tr]
[tr][td] int lastIndexOf(String str, int fromIndex)[/td][td] 返回 String 对象中子字符串最后出现的位置。 [/td][/tr]
[tr][td] int length() [/td][td] 返回长度（字符数）。[/td][/tr]
[tr][td] void setCharAt(int index, char ch)[/td][td] 将给定索引处的字符设置为 ch。[/td][/tr]
[tr][td] void setLength(int newLength)[/td][td] 设置字符序列的长度。[/td][/tr]
[tr][td] CharSequence subSequence(int start, int end) [/td][td] 返回一个新的字符序列，该字符序列是此序列的子序列。[/td][/tr]
[tr][td] String substring(int start)[/td][td] 返回一个新的 String，它包含此字符序列当前所包含的字符子序列。 [/td][/tr]
[tr][td] String substring(int start, int end) [/td][td] 返回一个新的 String，它包含此序列当前所包含的字符子序列。 [/td][/tr]
[tr][td] String toString() [/td][td] 返回此序列中数据的字符串表示形式。[/td][/tr]
[/tbody]
[/table]
";s:6:"to_top";i:0;s:3:"pic";s:58:"/static/head/20170726/e622618cf8c469ef33c5a5e31dc2f58c.png";s:7:"see_num";i:11;s:9:"argue_num";i:0;s:7:"is_best";i:0;s:11:"create_time";s:19:"2018-09-06 17:11:34";s:7:"type_id";i:2;s:4:"type";s:4:"JAVA";}