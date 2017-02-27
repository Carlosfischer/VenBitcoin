package holamundopackafge;
import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
/** * Servlet implementation class HolaMundo */@WebServlet("/holamundo")
public class holamundo extends HttpServlet {
	private static final long serialVersionUID = 1L;
	/** * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response) */
	protected void doGet(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException 
	{ // TODO Auto-generated method 
	PrintWriter out;
	out = response.getWriter();
	response.setContentType("text/html");
	out.println("<html>");
	out.println("<head><title>Ejemplo de Servlet</title></head>");
	out.println("<body>"); out.println("<h1>Hola Mundo</h1>");
	out.println("</body></html>");
	}
}
