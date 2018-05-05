import java.io.*;
import java.util.ArrayList;
import java.util.Scanner;
public class snortRulesFormatter
{
  public static void main(String[] args) throws Exception
  {
    String fileToFormat = "/var/www/snort/rules/userAddedRules";
    String fileToWriteTo = "/var/www/snort/rules/formattedUserAddedRules";
    File inFile = new File(fileToFormat);
    File outFile = new File(fileToWriteTo);
    Scanner input = new Scanner(inFile);
    PrintWriter out = new PrintWriter(outFile);
    while(input.hasNext())
    {
      String rule = input.nextLine();
      if(!rule.isEmpty())
        if(rule.charAt(0) != '#')
          out.println(formatToHTML(getRuleParts(rule)));
    }
    out.flush();
    out.close();
  }
  public static ArrayList<String> getRuleParts(String rule)
  {
    ArrayList<String> ruleParts = new ArrayList<String>();
    String options = "";
    if(rule.indexOf('(') > -1)
    {
      options = rule.substring(rule.indexOf('('), rule.length());
      rule = rule.substring(0,rule.indexOf('('));
    }
    String[] parts = rule.split(" ");
    for(String part : parts)
    {
      if(!part.equals("->") && !part.equals("<>"))
      ruleParts.add(part);
    }
    ruleParts.add(options);
    return ruleParts;
  }
  public static String formatToHTML(ArrayList<String> ruleParts)
  {
    String results = "<tr>\n";
    for(String part : ruleParts)
    {
      results+="<td>"+part+"</td>\n";
    }
    results+="</tr>\n";
    return results;
  }
}
