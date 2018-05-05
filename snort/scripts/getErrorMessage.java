import java.io.*;
import java.util.Scanner;
public class getErrorMessage
{
    public static void main(String[] msg) throws Exception
    {
        File file = new File("/var/www/snort/scripts/isError");
        Scanner input = new Scanner(file);
        String errorMsg = "";
        while(input.hasNext())
        {
            String line = input.nextLine();
            if(line.indexOf("ERROR:") > -1)
            {
                errorMsg=line+"\n";
                while(input.hasNext())
                {
                    line=input.nextLine();
                    errorMsg+=line;
                }
                errorMsg = errorMsg.substring(0, errorMsg.length()-line.length()-1);
                if(errorMsg.indexOf("otions") > -1)
                {
                    errorMsg = new StringBuilder(errorMsg).replace(errorMsg.indexOf("otions"),errorMsg.indexOf("otions")+"otions".length(),"options").toString();
                }
                errorMsg = errorMsg.substring(errorMsg.indexOf(":")+2);
                errorMsg = errorMsg.substring(errorMsg.indexOf(" ")+1);
            }
        }
        System.out.println(errorMsg);
    }
}
