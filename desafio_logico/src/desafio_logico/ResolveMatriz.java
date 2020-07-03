package desafio_logico;

import java.util.Scanner;

public class ResolveMatriz {

	public static void main(String[] args) {

		Scanner sc = new Scanner(System.in);
		
		System.out.print("Insira o tamanho da matriz:");
		int tamanhoMatriz = sc.nextInt();
		
		int[][] matriz = new int[tamanhoMatriz][tamanhoMatriz];
		
		System.out.println("Insira os valores da matriz:");
		
		for (int i = 0; i < matriz.length; i++) {
			for (int j = 0; j < matriz[i].length; j++) {
				matriz[i][j]=sc.nextInt();
			}
		}
		
		int diferenca = 0;
		for (int i = 0; i < matriz.length; i++) {
			diferenca += (matriz[i][i] - matriz[i][matriz.length - i - 1]);
		}
		
		System.out.println("A diferença entre a soma das diagonais da matriz é " + diferenca);
		
		
		sc.close();		
	}

}
