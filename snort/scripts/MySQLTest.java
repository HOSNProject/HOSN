import java.sql.*;
class MySQLTest{
    public static void main(String args[]){
        try{
            Class.forName("com.mysql.jdbc.Driver");
            Connection con=DriverManager.getConnection("jdbc:mysql://localhost:3306/IDS_IPS","IDS_IPS","IDSIPSADMIN");
            Statement stmt=con.createStatement();
            ResultSet rs=stmt.executeQuery("select * from admins");
            while(rs.next())
                System.out.println(rs.getString(1)+"  "+rs.getString(2));
            con.close();
        }
        catch(Exception e)
        {
            System.out.println(e);
        }
    }
}  
