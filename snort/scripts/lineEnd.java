import java.io.*;
import java.util.Scanner;

public class lineEnd 
{

	public static void main(String[] args) throws Exception
	{
		File file = new File("/var/www/snortLogs/alert");
		Scanner input = new Scanner(file);
		PrintWriter out = new PrintWriter("/var/www/snortLogs/alertFixed.txt");
		while (input.hasNext()) 
		{
			String results = input.nextLine();
			out.println("<h4>"+results+"</h4>");
		}
		out.close();
		input.close();
	}

}
